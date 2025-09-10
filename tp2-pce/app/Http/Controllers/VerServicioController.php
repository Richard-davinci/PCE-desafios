<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerServicioController extends Controller
{
    public function verServicio()
    {
        return view('ver-servicio');
    }
}
