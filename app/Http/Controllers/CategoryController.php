<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Exports\CategoryExport;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $data = Category::withCount('items')->get(); 
        return view('categories.index', compact('data'));
    }
    // public function index()
    // {
    //     $data = Category::all();
    //     return view('categories.index', compact('data'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'division' => 'required'
        ]);

        Category::create([
            'name' => $request->name,
            'division' => $request->division
        ]);

        return redirect('/categories');
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
    public function edit($id)
    {
    $data = Category::find($id);
    return view('categories.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    $request->validate([
        'name' => 'required',
        'division' => 'required'
    ]);

    $data = Category::find($id);
    $data->update([
        'name' => $request->name,
        'division' => $request->division
    ]);

    return redirect('/categories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Category::destroy($id);
        return redirect('/categories');
    }

    public function exportExcel()
{
    return Excel::download(new CategoryExport, 'categories.xlsx');
}
}