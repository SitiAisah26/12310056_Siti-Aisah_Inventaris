<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lending;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class LendingController extends Controller
{
    public function index() 
    {
        $lendings = Lending::with('item')->latest()->get();
        return view('lendings.index', compact('lendings'));
    }

    public function create()
    {
        $items = Item::all();
        return view('lendings.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required',
            'name' => 'required',
            'total' => 'required|integer|min:1',    
        ]);

        $item = Item::findOrFail($request->item_id);
    
        $currentlyLent = Lending::where('item_id', $item->id)->where('is_returned', false)->sum('total');
        $availableStock = $item->total - $item->repair - $currentlyLent;

        if ($availableStock < $request->total) {
            return back()->with('error', 'Stok tidak mencukupi! Sisa stok tersedia: ' . $availableStock);
        }

        Lending::create([
            'item_id' => $request->item_id,
            'name' => $request->name,
            'total' => $request->total,
            'date_time' => now(),
            'notes' => $request->notes,
            'is_returned' => false,
            'user_id' => Auth::user()->name 
        ]);

        return redirect()->route('lendings.index')->with('success', 'Success add new lending item!');
    }

    public function restore($id)
    {
        $lending = Lending::findOrFail($id);
        
        if ($lending->is_returned) {
            return back()->with('error', 'Barang ini sudah dikembalikan sebelumnya.');
        }

        $lending->update([
            'is_returned' => true,
            'return_date' => now()
        ]);

        return back()->with('success', 'Item has been returned!');
    }

    public function destroy($id)
    {
        $lending = Lending::findOrFail($id);
        $lending->delete();

        return back()->with('success', 'Success deleted one data lending!');
    }
}