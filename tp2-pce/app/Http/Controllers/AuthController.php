<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{

  public function register(Request $request)
  {
    $data = request()->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|string|min:6|confirmed',
    ]);

    User::create([
      'name' => $data['name'],
      'email' => $data['email'],
      'password' => Hash::make($data['password']),
      'role' => 'user',
    ]);
    return redirect()->route('login')->with('success', 'Usuario registrado correctamente. Por favor inicia sesión');
  }

  public function showLogin()
  {
    return view('auth.auth');
  }

  public function login(Request $request)
  {
    $credentials = $request->validate([
      'email' => 'required|email',
      'password' => 'required|string',
    ]);

    $remember = $request->boolean('remember');

    if (Auth::attempt($credentials, $remember)) {
      $request->session()->regenerate();

      $user = Auth::user();

      // Si el admin marcó reseteo, obligamos a cambiar la contraseña
      if ($user->must_change_password) {
        return redirect()
          ->route('force.form')
          ->with('info', 'Antes de continuar, debés actualizar tu contraseña.');
      }

      if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard')->with('success', 'Bienvenido Administrador.');
      }
      return redirect()->route('pages.index')->with('success', 'Bienvenido de nuevo.');
    }
    return back()->withErrors(['email' => 'Las credenciales no coinciden con nuestros registros.',])->onlyInput('email');
  }

  function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('pages.index');
  }

  public function myProfile()
  {

    if (Auth::user()->role === 'admin') {
      return view('auth.myProfileAdmin');
    } else {
      return view('auth.myProfileUser');
    }
  }

}
