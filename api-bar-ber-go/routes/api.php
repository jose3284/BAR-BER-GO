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
use App\Http\Controllers\AuthController;


// Rutas para las citas
Route::get('/cita', [CitaController::class, 'index']);
Route::get('/cita/{id}', [CitaController::class, 'show']);
Route::post('/cita', [CitaController::class, 'store']);
Route::put('/cita/{id}', [CitaController::class, 'update']);
Route::delete('/cita/{id}', [CitaController::class, 'destroy']);

// Rutas para los usuarios

Route::get('/usuarios', [UsersController::class, 'UserIndex']);
Route::get('/usuarios/{id}', [UsersController::class, 'UserShow']);
Route::post('/usuarios', [UsersController::class, 'UserStore']);
Route::put('/usuarios/{id}', [UsersController::class, 'UserUpdate']);
Route::delete('/usuarios/{id}', [UsersController::class, 'UserDestroy']);

// Rutas para los productos
Route::get('/producto', [ProductoController::class, 'ProductoIndex']);
Route::get('/producto/{id}', [ProductoController::class, 'ProductoShow']);
Route::post('/producto', [ProductoController::class, 'ProductoStore']);
Route::put('/producto/{id}', [ProductoController::class, 'ProductoUpdate']);
Route::delete('/producto/{id}', [ProductoController::class, 'ProductoDestroy']);

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

// Login y Logout

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::get('/productos/estadisticas', [ProductoController::class, 'estadisticas']);
Route::get('/productos/estadisticas/pdf', [ProductoController::class, 'generarPDF']);

Route::get('/cita/estadisticas', [CitaController::class, 'estadisticas']);
Route::get('/cita/estadisticas/pdf', [CitaController::class, 'generarPDF']);

// Ruta para obtener estadísticas de recibos
Route::get('/recibos/estadisticas', [ReciboController::class, 'estadisticas']);

// Ruta para generar el PDF de estadísticas de recibos
Route::get('/recibos/pdf', [ReciboController::class, 'generarPDF']);