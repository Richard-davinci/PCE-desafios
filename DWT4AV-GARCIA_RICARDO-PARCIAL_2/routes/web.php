<?php

use App\Http\Controllers\{AdminController,
  AuthController,
  CategoryController,
  ForcedPasswordController,
  PageController,
  PlanController,
  ServicesController,
  SubscriptionController,
  UserController};
use Illuminate\Support\Facades\Route;


/*
--------------------------------------------------------------------------
                       Páginas públicas
--------------------------------------------------------------------------
*/

Route::get('/', [PageController::class, 'index'])
  ->name('pages.index');
Route::get('/nosotros', [PageController::class, 'about'])
  ->name('pages.about');
Route::get('/servicios', [PageController::class, 'services'])
  ->name('pages.services');
Route::get('/servicios/{service}', [PageController::class, 'viewService'])
  ->name('pages.viewService');
Route::get('/contacto', [PageController::class, 'contact'])
  ->name('pages.contact');
Route::get('/error404', [PageController::class, 'error404'])
  ->name('pages.error404');
/*
--------------------------------------------------------------------------
                       Autenticación
--------------------------------------------------------------------------
*/

Route::get('/acceder', [AuthController::class, 'showLogin'])
  ->name('login');

Route::post('/login', [AuthController::class, 'login'])
  ->name('login.store');

Route::post('/register', [AuthController::class, 'register'])
  ->name('register.store');

Route::get('/logout', [AuthController::class, 'logout'])
  ->name('logout');

/*
--------------------------------------------------------------------------
                 Zona protegida
--------------------------------------------------------------------------
*/
Route::get('/myProfile', [AuthController::class, 'myProfile'])
  ->name('user.myProfile')
  ->middleware('protegida');

Route::put('/myProfile', [AuthController::class, 'updateProfile'])
  ->name('profile.update')
  ->middleware('protegida');

Route::put('/updatePassword', [AuthController::class, 'updatePassword'])
  ->name('profile.password.update')
  ->middleware('protegida');

/*
--------------------------------------------------------------------------
            Panel de Administración
--------------------------------------------------------------------------
*/
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
  ->name('admin.dashboard')
  ->middleware(['protegida', 'admin.only']);
/*
--------------------------------------------------------------------------
            Panel de categories
--------------------------------------------------------------------------
*/
Route::resource('admin/categories', CategoryController::class)
  ->names('admin.categories')
  ->except(['show'])
  ->middleware(['protegida', 'admin.only']);
/*
--------------------------------------------------------------------------
            Panel de servicios
--------------------------------------------------------------------------
*/
Route::resource('/admin/services', ServicesController::class)
  ->names('admin.services')
  ->middleware(['protegida', 'admin.only']);
/*
--------------------------------------------------------------------------
            Panel de planes del servicio
--------------------------------------------------------------------------
*/
Route::get('/admin/services/{service}/plans/create', [PlanController::class, 'create'])
  ->name('admin.services.plans.create')
  ->middleware(['protegida', 'admin.only']);

Route::post('/admin/services/{service}/plans', [PlanController::class, 'store'])
  ->name('admin.services.plans.store')
  ->middleware(['protegida', 'admin.only']);

Route::get('/admin/services/{service}/plans/edit', [PlanController::class, 'edit'])
  ->name('admin.services.plans.edit')
  ->middleware(['protegida', 'admin.only']);

Route::put('/admin/services/{service}/plans', [PlanController::class, 'update'])
  ->name('admin.services.plans.update')
  ->middleware(['protegida', 'admin.only']);
/*
--------------------------------------------------------------------------
                Usuarios admin (resource + reset password)
--------------------------------------------------------------------------
*/
Route::resource('/admin/users', UserController::class)
  ->names('admin.users')
  ->middleware(['protegida', 'admin.only']);
Route::patch('/admin/users/{user}/reset-password', [UserController::class, 'resetPassword'])
  ->name('admin.users.reset-password')
  ->middleware(['protegida', 'admin.only']);
/*
--------------------------------------------------------------------------
                               Unauthorized admin
--------------------------------------------------------------------------
*/
Route::get('/admin/unauthorized', [AdminController::class, 'unauthorized'])
  ->name('admin.unauthorized');
/*
--------------------------------------------------------------------------
                      Forzar cambio de contraseña
--------------------------------------------------------------------------
*/
Route::get('/force-change', [ForcedPasswordController::class, 'show'])
  ->name('force.form')
  ->middleware('protegida');
Route::post('/force-change', [ForcedPasswordController::class, 'update'])
  ->name('force.update')
  ->middleware('protegida');

/*
|--------------------------------------------------------------------------
| Checkout
|--------------------------------------------------------------------------
*/
Route::get('/checkout/preview', [SubscriptionController::class, 'preview'])
  ->name('checkout.preview')
  ->middleware('protegida');

Route::post('/checkout/confirm', [SubscriptionController::class, 'confirm'])
  ->name('checkout.confirm')
  ->middleware('protegida');

// Gracias
Route::get('/checkout/thanks', [SubscriptionController::class, 'thanks'])
  ->name('checkout.thanks')
  ->middleware('protegida');

/*
--------------------------------------------------------------------------
 Mis Suscripciones
--------------------------------------------------------------------------
*/
Route::get('/my-subscriptions', [SubscriptionController::class, 'userIndex'])
  ->name('user.subscriptions')
  ->middleware('protegida');

Route::get('/suscripciones/ya-existe/{subscription}', [SubscriptionController::class, 'already'])
  ->name('errors.already')
  ->middleware('protegida');











