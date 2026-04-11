<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.app');
});
 
Route::get('/', function () {
    return view('dashboard');
});

Route::resource('categories', CategoryController::class);
Route::resource('items', ItemController::class);
Route::get('/items/{item}/lendings', [ItemController::class, 'lendings'])
    ->name('items.lendings');
