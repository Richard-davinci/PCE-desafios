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

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'dashboard'])
    ->name('admin.dashboard');

Route::get('/crear-servicio', [\App\Http\Controllers\CrearServicioController::class, 'crearServicio'])
    ->name('admin.crear-servicio');

Route::get('/crear-usuario', [\App\Http\Controllers\CrearUsuarioController::class, 'crearUsuario'])
    ->name('admin.crear-usuario');

Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'admin'])
    ->name('admin.admin');

Route::get('/perfil', [\App\Http\Controllers\MiPerfilController::class, 'perfil'])
    ->name('usuario.mi-perfil');;

Route::get('/iniciar-sesion', [\App\Http\Controllers\IniciarController::class, 'iniciar'])
    ->name('admin.iniciar-sesion');

Route::get('/iniciar-usuario', [\App\Http\Controllers\IniciarUsuarioController::class, 'iniciarUsuario'])
    ->name('usuario.iniciar-usuario');




