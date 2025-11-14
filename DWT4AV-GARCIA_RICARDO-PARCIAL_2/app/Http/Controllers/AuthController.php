<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use \Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
  public function register(Request $request)
  {
    try {
      $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'unique:users,email'],
        'password' => ['required', 'confirmed', 'min:6'],
      ], [
        'name.required' => 'Ingresá tu nombre.',
        'email.required' => 'Ingresá tu email.',
        'email.email' => 'El formato de email no es válido.',
        'email.unique' => 'Este email ya está registrado.',
        'password.required' => 'Ingresá una contraseña.',
        'password.confirmed' => 'Las contraseñas no coinciden.',
        'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
      ]);
    } catch (ValidationException $error) {
      return back()
        ->withErrors($error->validator)
        ->withInput()
        ->with('auth_tab', 'registro');
    }

    $user = User::create([
      'name' => $data['name'],
      'email' => $data['email'],
      'role' => 'user',
      'password' => Hash::make($data['password']),
    ]);

    Auth::login($user);

    return redirect()->route('pages.index');
  }

  public function showLogin()
  {
    return view('auth.auth');
  }



  public function login(Request $request)
  {
    try {
      $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required', 'string'],
      ], [
        'email.required' => 'Ingresá tu email.',
        'email.email' => 'El formato de email no es válido.',
        'password.required' => 'Ingresá tu contraseña.',
      ]);
    } catch (ValidationException $e) {
      return back()
        ->withErrors($e->validator)
        ->withInput()
        ->with('auth_tab', 'login');
    }

    $remember = $request->boolean('remember');

    // Intentar autenticación
    if (Auth::attempt($credentials, $remember)) {
      $request->session()->regenerate();

      $user = Auth::user();

      // Si debe cambiar la contraseña
      if ($user->must_change_password) {
        return redirect()
          ->route('force.form')
          ->with('info', 'Antes de continuar, debés actualizar tu contraseña.');
      }

      // Redirección según rol
      if ($user->role === 'admin') {
        return redirect()
          ->route('admin.dashboard')
          ->with('success', 'Bienvenido ' . $user->name);
      }

      return redirect()
        ->route('pages.index')
        ->with('success', 'Bienvenido de nuevo.');
    }

    // Si las credenciales no coinciden → volver al tab LOGIN
    return back()
      ->withErrors(['email' => 'Las credenciales no coinciden con nuestros registros.'])
      ->withInput()
      ->with('auth_tab', 'login');
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
    $user = Auth::user();
    return view('auth.myProfileUser', compact('user'));
  }


  public function updateProfile(Request $request)
  {
    $user = Auth::user();
    try {
      $data = $request->validate([
        'phone' => ['nullable', 'digits_between:8,20'],
        'city' => ['nullable', 'regex:/^[\pL\s]+$/u', 'min:3', 'max:100'],
        'profile_photo' => ['nullable', 'image', 'max:2048'],
      ], [
        'phone.digits_between' => 'El teléfono debe tener entre 8 y 20 números.',
        'city.regex' => 'La ciudad solo puede contener letras y espacios.',
        'city.min' => 'La ciudad debe tener al menos 3 caracteres.',
        'city.max' => 'La ciudad no puede superar los 100 caracteres.',
        'profile_photo.image' => 'El archivo debe ser una imagen válida.',
        'profile_photo.max' => 'La imagen no puede pesar más de 2 MB.',
      ]);

    } catch (ValidationException $e) {
      // Si falla cualquier validación, volver al tab "editar"
      return back()
        ->withErrors($e->validator)
        ->withInput()
        ->with('active_tab', 'editar');
    }

    $user->fill([
      'phone' => $data['phone'] ?? $user->phone,
      'city' => $data['city'] ?? $user->city,
    ]);

    if ($request->hasFile('profile_photo')) {
      if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
        Storage::disk('public')->delete($user->profile_photo);
      }

      $path = $request->file('profile_photo')->store('img/users', 'public');
      $user->profile_photo = $path;
    }

    $user->save();

    return back()
      ->with('success', 'Perfil actualizado correctamente.')
      ->with('active_tab', 'ver');
  }


  public
  function updatePassword(Request $request)
  {
    $user = Auth::user();

    try {
      $request->validate([
        'current_password' => ['required'],
        'password' => ['required', 'confirmed', 'min:6'],
      ], [
        'current_password.required' => 'Debés ingresar tu contraseña actual.',
        'password.required' => 'Ingresá una nueva contraseña.',
        'password.confirmed' => 'Las contraseñas no coinciden.',
        'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
      ]);
    } catch (ValidationException $e) {
      // Si falla cualquier validación, volver al tab "password"
      return back()
        ->withErrors($e->validator)
        ->withInput()
        ->with('active_tab', 'password');
    }

    // Verificar contraseña actual
    if (!Hash::check($request->current_password, $user->password)) {
      return back()
        ->withErrors(['current_password' => 'La contraseña actual no es correcta.'])
        ->withInput()
        ->with('active_tab', 'password');
    }

    // Actualizar contraseña
    $user->password = Hash::make($request->password);
    $user->must_change_password = false;
    $user->save();

    return back()
      ->with('success_password', 'Contraseña actualizada correctamente.')
      ->with('active_tab', 'ver'); // vuelve al tab principal
  }


}
