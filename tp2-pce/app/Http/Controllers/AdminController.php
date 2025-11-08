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
    $users      = User::all();                 // Todos los usuarios
    $usersToday = User::today()->count();      // Usuarios creados hoy
    $lastUsers  = User::latest()->take(5)->get(); // Últimos 5 usuarios

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

    // 🔹 Últimos registros
    $latestUsers      = $lastUsers; // reutilizo tu consulta
    $latestServices   = Service::with('category')->latest()->take(5)->get();
    $latestCategories = Category::withCount('services')->latest()->take(5)->get();

    // 🔹 Enviamos todo a la vista
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
