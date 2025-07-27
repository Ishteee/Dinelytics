<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

// Dashboard homepage
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Dishes page
Route::get('/dishes', [DashboardController::class, 'dishesIndex'])->name('dishes.index');

// Orders page
Route::get('/orders', [DashboardController::class, 'ordersIndex'])->name('orders.index');
