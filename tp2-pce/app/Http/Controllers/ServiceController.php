<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    function service()
    {
        return view('service');
    }
    public function viewService()
    {
        return view('viewService');
    }
}
