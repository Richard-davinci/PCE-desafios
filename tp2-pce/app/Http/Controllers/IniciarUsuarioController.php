<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IniciarUsuarioController extends Controller
{
    public function iniciarUsuario(){
        return view('usuario.iniciar-sesion');
    }
}
