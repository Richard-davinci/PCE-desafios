<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
  public function dashboard()
  {
    $rolesStats = User::getRolesStats(); //obtengo un array asociativo de roles
    $users = User::all(); // todos los usuarios
    $usersToday = User::today()->count(); // usuarios de hoy
    $lastUsers = User::latest()->take(5)->get(); // Últimos 5 usuarios

    return view('admin.dashboard', compact('rolesStats', 'users', 'usersToday', 'lastUsers'));

  }


  public function unauthorized()
  {
    return view('admin.unauthorized');
  }

}
