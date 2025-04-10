<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\CitaController; // Ruta del controlador 
use App\Models\cita; // Ruta del modelo 

Route::get('/cita', [CitaController::class, 'index']); // Muestra todas las citas agendadas 

Route::get('/cita/{id}', [CitaController::class, 'show']); // Muestra una cita agendada especifica por el id

Route::post('/cita', [CitaController::class, 'store']); // Agrega una nueva cita 

Route::put('/cita/{id}', [CitaController::class, 'update']); // Actualiza una cita ya creada 

Route::delete('/cita/{id}', [CitaController::class, 'destroy']); // Elimina una cita ya creada 

