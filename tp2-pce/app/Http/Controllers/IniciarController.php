<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IniciarController extends Controller
{
    public function iniciar(){
        return view('admin.iniciar-sesion');
    }
}
