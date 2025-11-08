<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
  /**
   * Listado de usuarios
   */
  public function index(Request $request)
  {
    $query = User::query();

    // Filtros dinámicos
    if ($request->filled('name')) {
      $query->where('name', 'like', '%' . $request->name . '%');
    }

    if ($request->filled('email')) {
      $query->where('email', 'like', '%' . $request->email . '%');
    }

    if ($request->filled('role')) {
      $query->where('role', $request->role);
    }

    if ($request->filled('status')) {
      $query->where('status', $request->status);
    }

    // Ordenar por fecha más reciente
    $users = $query->orderBy('created_at', 'desc')->paginate(6);

    return view('admin.users.index', compact('users'));
  }


  /**
   * Formulario: crear nuevo usuario (user o admin).
   */
  public function create()
  {
    return view('admin.users.create');
  }

  /**
   * Guardar nuevo usuario creado por el admin.
   */
  public function store(Request $request)
  {
    $data = $request->validate([
      'name'   => ['required', 'string', 'max:255'],
      'email'  => ['required', 'email', 'max:255', 'unique:users,email'],
      'role'   => ['required', 'in:admin,user'],
      'status' => ['nullable', 'in:activo,inactivo'],
      'password' => ['nullable', 'string', 'min:6'],
    ]);

    // Si no se envía contraseña, generar una aleatoria simple
    $plainPassword = $data['password'] ?? Str::random(8);

    $user = User::create([
      'name'     => $data['name'],
      'email'    => $data['email'],
      'role'     => $data['role'],
      'status'   => $data['status'] ?? 'activo',
      'password' => Hash::make($plainPassword),
    ]);

    // Mostrar la contraseña solo una vez al admin
    return redirect()
      ->route('admin.users.index')
      ->with('success', "Usuario creado correctamente. Contraseña: {$plainPassword}");
  }

  /**
   * Formulario: editar datos básicos del usuario.
   */
  public function edit(User $user)
  {
    return view('admin.users.edit', compact('user'));
  }

  /**
   * Actualizar usuario (nombre, email, rol, estado).
   * El perfil extra lo maneja el propio usuario desde su cuenta.
   */
  public function update(Request $request, User $user)
  {
    $data = $request->validate([
      'name'   => ['required', 'string', 'max:255'],
      'email'  => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
      'role'   => ['required', 'in:admin,user'],
      'status' => ['required', 'in:activo,inactivo'],
    ]);

    $user->update($data);

    return redirect()
      ->route('admin.users.index')
      ->with('success', 'Usuario actualizado correctamente.');
  }

  /**
   * Resetear contraseña: genera una nueva y la muestra al admin.
   */
  public function resetPassword(User $user)//se marca q la contraseña se debe cambiar al iniciar sesion
  {
    $user->update([
      'must_change_password' => true,
    ]);

    return redirect()
      ->route('admin.users.index')
      ->with('success', "Se marcó al usuario {$user->name} para cambiar su contraseña en el próximo inicio de sesión.");
  }

  /**
   * Eliminar usuario (si querés mantenerlo simple, borrado directo).
   * Podés cambiar a soft deletes más adelante.
   */
  public function destroy(User $user)
  {
    $user->delete();

    return redirect()
      ->route('admin.users.index')
      ->with('success', 'Usuario eliminado correctamente.');
  }
}
