<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrearUsuarioController extends Controller
{
    public function crearUsuario(){
        return view('admin.crear-usuario');
    }
}
