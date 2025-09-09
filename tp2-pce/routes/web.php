<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class , 'home']);

Route::get('/quienes-somos', [\App\Http\Controllers\AboutController::class , 'about']);

