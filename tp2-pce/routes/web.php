<?php

use App\Http\Controllers\{AdminController, AuthController, CategoryController, PageController, ServiceController,UserController};
use Illuminate\Support\Facades\Route;

// Páginas públicas
Route::get('/', [PageController::class, 'home'])
  ->name('pages.home');
Route::get('/nosotros', [PageController::class, 'about'])
  ->name('pages.about');
Route::get('/contacto', [PageController::class, 'contact'])
  ->name('pages.contact');
Route::get('/servicio', [PageController::class, 'service'])
  ->name('pages.service');
Route::get('/ver-servicio', [PageController::class, 'viewService'])
  ->name('pages.viewService');
Route::get('/404', [PageController::class, 'error404'])
  ->name('pages.error404');

// Autenticación
Route::get('/mi-perfil', [AuthController::class, 'myProfile'])
  ->name('user.myProfile');
/*Route::get('/login-admin', [AuthController::class, 'login'])->name('admin.login');
Route::get('/login-user', [AuthController::class, 'loginUser'])->name('user.loginUser');*/

// Autenticación posta
Route::get('/login', [AuthController::class, 'showLogin'])
  ->name('login');
Route::post('/register', [AuthController::class, 'register'])
  ->name('register.store');
Route::post('/login', [AuthController::class, 'login'])
  ->name('login.store');
Route::get('/logout', [AuthController::class, 'logout'])
  ->name('logout');

//servicios

// categorias
Route::resource('categories', CategoryController::class)->except(['show']);

// Panel Admin
Route::resource('services', ServiceController::class)
  ->middleware('protegida', 'admin.only');;

Route::get('/dashboard', [AdminController::class, 'dashboard'])
  ->name('admin.dashboard');

Route::get('/crear-user', [AdminController::class, 'createUser'])
  ->name('admin.createUser')
  ->middleware('protegida', 'admin.only');
Route::get('/admin', [AdminController::class, 'admin'])
  ->name('admin.admin')
  ->middleware('protegida', 'admin.only');
// Índice de usuarios
Route::get('/users', [UserController::class, 'index'])->name('users.index');


Route::get('/unauthorized', [AdminController::class, 'unauthorized'])
  ->name('unauthorized');
