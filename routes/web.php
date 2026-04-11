<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\UserController;

// Landing Page 
Route::get('/', function () {
    return view('welcome'); // Mengarah ke welcome.blade.php
})->name('landing');

// (Login/Logout)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('categories', CategoryController::class);
    Route::resource('items', ItemController::class);
    Route::resource('lendings', LendingController::class);
    
    Route::get('/items/{item}/lendings', [ItemController::class, 'lendings'])->name('items.lendings');

    Route::resource('users', UserController::class);
    
});
    