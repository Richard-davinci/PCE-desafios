<?php

use App\Http\Controllers\{AdminController, AuthController, PageController, ServiceController};
use Illuminate\Support\Facades\Route;

// Páginas públicas
Route::get('/', [PageController::class, 'home'])->name('pages.home');
Route::get('/nosotros', [PageController::class, 'about'])->name('pages.about');
Route::get('/contacto', [PageController::class, 'contact'])->name('pages.contact');
Route::get('/servicio', [PageController::class, 'service'])->name('pages.service');
Route::get('/ver-servicio', [PageController::class, 'viewService'])->name('pages.viewService');

// Autenticación
Route::get('/mi-perfil', [AuthController::class, 'myProfile'])->name('user.myProfile');
/*Route::get('/login-admin', [AuthController::class, 'login'])->name('admin.login');
Route::get('/login-user', [AuthController::class, 'loginUser'])->name('user.loginUser');*/

// Autenticación posta

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//servicios
Route::resource('services', ServiceController::class);

// Panel Admin
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('protegida');
Route::get('/crear-user', [AdminController::class, 'createUser'])->name('admin.createUser')->middleware('protegida');
Route::get('/admin', [AdminController::class, 'admin'])->name('admin.admin')->middleware('protegida');






