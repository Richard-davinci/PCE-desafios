<?php

use App\Http\Controllers\{AdminController,
  AuthController,
  CategoryController,
  ForcedPasswordController,
  PageController,
  PlanController,
  ServicesController,
  UserController};
use Illuminate\Support\Facades\Route;

// Páginas públicas
Route::get('/', [PageController::class, 'index'])->name('pages.index');
Route::get('/about', [PageController::class, 'about'])->name('pages.about');
Route::get('/contact', [PageController::class, 'contact'])->name('pages.contact');
Route::get('/servicios', [PageController::class, 'services'])->name('pages.services');
Route::get('/viewService/{service}', [PageController::class, 'viewService'])->name('pages.viewService');

// Autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::get('/myProfile', [AuthController::class, 'myProfile'])->name('user.myProfile');
Route::put('/myProfile/actualizar', [AuthController::class, 'updateProfile'])->name('profile.update');


Route::middleware('auth')->group(function () {
  Route::get('/force-change', [ForcedPasswordController::class, 'show'])
    ->name('force.form');

  Route::post('/force-change', [ForcedPasswordController::class, 'update'])
    ->name('force.update');
});

// categorias
Route::resource('admin/categories', CategoryController::class)->names('admin.categories')->except(['show']);

// Planes por servicio
Route::middleware(['protegida', 'admin.only'])->prefix('admin')->name('admin.')->group(function () {
  Route::get('/services/{service}/plans/create', [PlanController::class, 'create'])->name('services.plans.create');
  Route::post('/services/{service}/plans', [PlanController::class, 'store'])->name('services.plans.store');
  Route::get('/services/{service}/plans/edit', [PlanController::class, 'edit'])->name('services.plans.edit');
  Route::put('/services/{service}/plans', [PlanController::class, 'update'])->name('services.plans.update');
});


// Panel Admin
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

//servicios
Route::resource('/admin/services', ServicesController::class)->names('admin.services')->middleware('protegida', 'admin.only');

// usuarios
// usuarios
Route::resource('/admin/users', UserController::class)->names('admin.users')->middleware('protegida', 'admin.only');

Route::patch('/admin/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('admin.users.reset-password')
  ->middleware('protegida', 'admin.only');


Route::get('/admin/unauthorized', [AdminController::class, 'unauthorized'])->name('unauthorized');
Route::get('/404', [PageController::class, 'error404'])->name('pages.error404');






