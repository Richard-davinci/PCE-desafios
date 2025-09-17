<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MiPerfilController extends Controller
{
    public function perfil(){
        return view('usuario.mi-perfil');
    }
}
