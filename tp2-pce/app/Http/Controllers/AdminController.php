<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{

  public function dashboard()
  {


    return view('admin.dashboard');
  }

  public function unauthorized()
  {
    return view('admin.unauthorized');
  }

}
