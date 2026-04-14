<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lending;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use App\Exports\LendingsExport;
use Maatwebsite\Excel\Facades\Excel;

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
        'name' => 'required',
        'items' => 'required|array'
    ]);

    foreach ($request->items as $data) {

        $item = Item::findOrFail($data['item_id']);

        $currentlyLent = Lending::where('item_id', $item->id)
            ->where('is_returned', false)
            ->sum('total');

        $availableStock = $item->total - $item->repair - $currentlyLent;

        if ($data['total'] > $availableStock) {
            return back()->with('error', 'total item more than available');
        }

        Lending::create([
            'item_id' => $data['item_id'],
            'name' => $request->name,
            'total' => $data['total'],
            'date_time' => now(),
            'notes' => $request->notes,
            'is_returned' => false,
            'user_id' => Auth::user()->name
        ]);
    }

    return redirect()->route('lendings.index')->with('success', 'Success add new lending!');
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
    $wasReturned = $lending->is_returned;
    $lending->delete();
    return back()->with('success', 'success deleted one data lending!');
    }

    public function export() 
    {
        return Excel::download(new LendingsExport, 'data-peminjaman.xlsx');
    }
}   