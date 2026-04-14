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
    return view('welcome'); 
})->name('landing');

// (Login/Logout)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['auth'])->group(function () {
    // Export & Index (GET)

    Route::get('/items/export', [ItemController::class, 'export'])->name('items.export');
    Route::get('/users/export', [UserController::class, 'export'])->name('users.export');
    Route::get('/lendings/export', [LendingController::class, 'export'])->name('lendings.export');
    Route::get('/categories/export', [CategoryController::class, 'exportExcel'])->name('categories.export');
    Route::get('/users/admin', [UserController::class, 'indexAdmin'])->name('users.admin.index');
    Route::get('/users/operator', [UserController::class, 'indexOperator'])->name('users.operator.index');
    
    // Reset Password (PATCH)
    Route::patch('/users/{id}/reset', [UserController::class, 'resetPassword'])->name('users.reset');

    Route::resource('items', ItemController::class);
    Route::resource('users', UserController::class)->except(['index']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/items/{item}/lendings', [ItemController::class, 'lendings'])->name('items.lendings');
    Route::patch('/lendings/{id}/return', [LendingController::class, 'restore'])->name('lendings.restore');


    Route::resource('categories', CategoryController::class);
    Route::resource('items', ItemController::class);
    Route::resource('lendings', LendingController::class);
    
    
  
});
    