<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PageController,
    ServiceController,
    AuthController,
    AdminController
};

// Páginas públicas
Route::get('/',           [PageController::class, 'home'])                 ->name('home');
Route::get('/nosotros',   [PageController::class, 'about'])                ->name('about');
Route::get('/contacto',   [PageController::class, 'contact'])              ->name('contact');

// Servicios
Route::get('/servicio',     [ServiceController::class, 'service'])         ->name('service');
Route::get('/ver-servicio', [ServiceController::class, 'viewService'])     ->name('viewService');

// Autenticación
Route::get('/mi-perfil',     [AuthController::class, 'myProfile'])         ->name('usuario.myProfile');;
Route::get('/login-admin',   [AuthController::class, 'login'])             ->name('admin.login');
Route::get('/login-usuario', [AuthController::class, 'loginUser'])         ->name('usuario.loginUser');

// Panel Admin
Route::get('/tablero',        [AdminController::class, 'dashboard'])        ->name('admin.dashboard');
Route::get('/crear-servicio', [AdminController::class, 'createService'])    ->name('admin.createService');
Route::get('/crear-usuario',  [AdminController::class, 'createUser'])       ->name('admin.createUser');
Route::get('/admin',          [AdminController::class, 'admin'])            ->name('admin.admin');






