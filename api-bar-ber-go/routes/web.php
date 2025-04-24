<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/login', function () {
    return "Por favor inicia sesión.";
})->name('login');

