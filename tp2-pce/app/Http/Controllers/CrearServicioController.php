<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrearServicioController extends Controller
{
    public function crearServicio(){
        return view('admin.crear-servicio');
    }
}
