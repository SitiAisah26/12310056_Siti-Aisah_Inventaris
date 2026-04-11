<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LendingController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'item_id' => 'required',
        'borrower_name' => 'required',
        'qty' => 'required|integer',
    ]);

    \App\Models\Lending::create([
        'item_id' => $request->item_id,
        'borrower_name' => $request->borrower_name,
        'qty' => $request->qty,
        'date_time' => now(),
    ]);

    return redirect()->back()->with('success', 'Barang berhasil dipinjam!');
}
}
