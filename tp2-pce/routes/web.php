<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{CategoryController, PageController, ServiceController, AuthController, AdminController};

// Páginas públicas
Route::get('/',             [PageController::class, 'home'])                ->name('pages.home');
Route::get('/nosotros',     [PageController::class, 'about'])               ->name('pages.about');
Route::get('/contacto',     [PageController::class, 'contact'])             ->name('pages.contact');
Route::get('/servicio',     [PageController::class, 'service'])             ->name('pages.service');
Route::get('/ver-servicio', [PageController::class, 'viewService'])         ->name('pages.viewService');

// Autenticación
Route::get('/mi-perfil',     [AuthController::class, 'myProfile'])         ->name('user.myProfile');
Route::get('/login-admin',   [AuthController::class, 'login'])             ->name('admin.login');
Route::get('/login-user',    [AuthController::class, 'loginUser'])         ->name('user.loginUser');

//servicios
Route::resource('servicios', ServiceController::class);
Route::get('/crear-servicio', [ServiceController::class, 'create'])    ->name('service.create');

// Panel Admin
Route::get('/tablero',        [AdminController::class, 'dashboard'])        ->name('admin.dashboard');
Route::get('/crear-user',     [AdminController::class, 'createUser'])       ->name('admin.createUser');
Route::get('/admin',          [AdminController::class, 'admin'])            ->name('admin.admin');






