<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'inicio'])
    ->name('inicio');

Route::get('/nosotros', [\App\Http\Controllers\NosotrosController::class, 'nosotros'])
    ->name('nosotros');

Route::get('/servicios', [\App\Http\Controllers\ServiciosController::class, 'servicios'])
    ->name('servicios');

Route::get('/contacto', [\App\Http\Controllers\ContactoController::class, 'contacto'])
    ->name('contacto');

Route::get('/ver-servicio', [\App\Http\Controllers\VerServicioController::class, 'verServicio'])
    ->name('ver-servicio');

