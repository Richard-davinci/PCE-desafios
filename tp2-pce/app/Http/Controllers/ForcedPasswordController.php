<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForcedPasswordController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        if (!$user->must_change_password) {
            // Si no está marcado, lo mandamos a donde corresponda
            return $user->role === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('pages.index');
        }

        return view('auth.force-change');
    }

    public function update(Request $request)
    {
        $request->validate([
            'current_password'      => ['required'],
            'password'              => ['required', 'min:6', 'confirmed'],
        ]);

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()
                ->withErrors(['current_password' => 'La contraseña actual no es correcta.'])
                ->withInput();
        }

        $user->update([
            'password'             => Hash::make($request->password),
            'must_change_password' => false,
        ]);

        return $user->role === 'admin'
            ? redirect()->route('admin.dashboard')->with('success', 'Contraseña actualizada.')
            : redirect()->route('pages.index')->with('success', 'Contraseña actualizada.');
    }
}
