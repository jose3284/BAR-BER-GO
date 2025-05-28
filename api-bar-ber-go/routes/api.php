<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MetodoPagoController;
use App\Http\Controllers\ReciboController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;


// Rutas para las citas
Route::get('/cita', [CitaController::class, 'index']);
Route::get('/cita/{id}', [CitaController::class, 'show']);
Route::post('/cita', [CitaController::class, 'store']);
Route::put('/cita/{id}', [CitaController::class, 'update']);
Route::delete('/cita/{id}', [CitaController::class, 'destroy']);
Route::get('/cita/estadisticas', [CitaController::class, 'estadisticas']);
Route::get('/cita/estadisticas/pdf', [CitaController::class, 'generarPDF']);

// Rutas para los usuarios

Route::get('/usuarios', [UsersController::class, 'UserIndex']);
Route::get('/usuarios/{id}', [UsersController::class, 'UserShow']);
Route::post('/usuarios', [UsersController::class, 'UserStore']);
Route::put('/usuarios/{id}', [UsersController::class, 'UserUpdate']);
Route::delete('/usuarios/{id}', [UsersController::class, 'UserDestroy']);

// Rutas para los productos
 Route::get('/producto', [ProductoController::class, 'index']);
    Route::get('/producto/{id}', [ProductoController::class, 'show']);
    Route::post('/producto', [ProductoController::class, 'store']);
    Route::put('/producto/{id}', [ProductoController::class, 'update']);
    Route::delete('/producto/{id}', [ProductoController::class, 'destroy']);
    Route::get('/producto/estadisticas', [ProductoController::class, 'estadisticas']);
    Route::get('/producto/reporte/pdf', [ProductoController::class, 'generarPDF']);
// Rutas para los Roles 

Route::get('/roles', [RolController::class, 'RolIndex']);
Route::get('/roles/{id}', [RolController::class, 'RolShow']);
Route::post('/roles', [RolController::class, 'RolStore']);
Route::put('/roles/{id}', [RolController::class, 'RolUpdate']);
Route::delete('/roles/{id}', [RolController::class, 'RolDestroy']);

// Rutas para las Categorias    

Route::get('/categorias', [CategoriaController::class, 'index']);
Route::get('/categorias/{id}', [CategoriaController::class, 'show']);
Route::post('/categorias', [CategoriaController::class, 'store']);
Route::put('/categorias/{id}', [CategoriaController::class, 'update']);
Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy']);

// Rutas para los metodos de pago 

Route::get('/metodo-pago', [MetodoPagoController::class, 'index']);
Route::get('/metodo-pago/{id}', [MetodoPagoController::class, 'show']);
Route::post('/metodo-pago', [MetodoPagoController::class, 'store']);
Route::put('/metodo-pago/{id}', [MetodoPagoController::class, 'update']);
Route::delete('/metodo-pago/{id}', [MetodoPagoController::class, 'destroy']);

// Rutas para los recibos

Route::get('/recibos', [ReciboController::class, 'index']);
Route::get('/recibos/{id}', [ReciboController::class, 'show']);
Route::post('/recibos', [ReciboController::class, 'store']);
Route::put('/recibos/{id}', [ReciboController::class, 'update']);
Route::delete('/recibos/{id}', [ReciboController::class, 'destroy']);
Route::get('/recibos/estadisticas', [ReciboController::class, 'estadisticas']);
Route::get('/recibos/pdf', [ReciboController::class, 'generarPDF']);

// Autenticación
Route::post('/login', [LoginController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [LoginController::class, 'logout']);

// Recuperación de contraseña
Route::post('/forgot-password', [PasswordResetController::class, 'forgotPassword']);
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);
