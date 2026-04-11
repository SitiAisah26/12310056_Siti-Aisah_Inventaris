<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Lending;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    

    public function index()
    {
        $items = Item::with('category')->withCount('lendings')->get();
        $categories = Category::all(); 
        return view('items.index', compact('items', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    

public function create()
{
    $categories = Category::all();
    return view('items.create', compact('categories'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'category_id' => 'required',
        'total' => 'required|integer|min:1',
    ]);

    Item::create([
        'name' => $request->name,
        'category_id' => $request->category_id,
        'total' => $request->total,
        'repair' => 0
    ]);

    return redirect()->route('items.index');
} 

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
{
    $categories = Category::all();
    return view('items.edit', compact('item', 'categories'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
{
    $request->validate([
        'name' => 'required',
        'category_id' => 'required',
        'total' => 'required|integer|min:1',
        'new_broke' => 'nullable|integer|min:0'
    ]);

    $newRepair = $item->repair + ($request->new_broke ?? 0);

    $item->update([
        'name' => $request->name,
        'category_id' => $request->category_id,
        'total' => $request->total,
        'repair' => $newRepair
    ]);

    return redirect()->route('items.index');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
{
    Item::destroy($id);
    return redirect('/items');
}

    public function lendings(Item $item)
    {   
        $item->load('lendings'); 
        $lendings = $item->lendings; 
        
        return view('items.lendings', compact('item', 'lendings'));
    }
}