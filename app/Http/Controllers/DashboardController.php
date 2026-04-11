<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
{
    // untuk ambil user yg lg login
    $user = auth()->user(); 
    $roleDisplay = ($user->role == 'admin') ? 'Admin Wikrama' : 'Operator Wikrama';

    return view('dashboard', compact('roleDisplay'));
}
}
