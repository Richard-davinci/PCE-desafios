<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\Category;

class AdminController extends Controller
{
  public function dashboard()
  {
    // Datos de usuarios
    $rolesStats = User::getRolesStats();
    $users      = User::all();
    $usersToday = User::today()->count();
    $lastUsers  = User::latest()->take(5)->get();

    // Totales para el dashboard
    $totalUsers  = $users->count();
    $totalAdmins = isset($rolesStats['admin'])
      ? (int) $rolesStats['admin']
      : 0;

    //Servicios y categorías
    $totalServices = Service::count();
    $servicesWithPlansCount    = Service::has('plans')->count();
    $servicesWithoutPlansCount = Service::doesntHave('plans')->count();

    $totalCategories = Category::count();
    $categoriesWithServicesCount = Category::has('services')->count();

    //Últimos registros
    $latestUsers      = $lastUsers;
    $latestServices   = Service::with('category')->latest()->take(5)->get();
    $latestCategories = Category::withCount('services')->latest()->take(5)->get();


    return view('admin.dashboard', compact(
      'rolesStats',
      'users',
      'usersToday',
      'lastUsers',
      'totalUsers',
      'totalAdmins',
      'totalServices',
      'servicesWithPlansCount',
      'servicesWithoutPlansCount',
      'totalCategories',
      'categoriesWithServicesCount',
      'latestUsers',
      'latestServices',
      'latestCategories'
    ));
  }

  public function unauthorized()
  {
    return view('admin.unauthorized');
  }
}
