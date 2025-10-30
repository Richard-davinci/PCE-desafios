<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
  public function admin()
  {
    return view('admin.admin');
  }

  public function dashboard()
  {
    return view('admin.dashboard');
  }

  public function createService()
  {
    return view('admin.createService');
  }

  public function createUser()
  {
    return view('admin.createUser');
  }

  public function unauthorized()
  {
    return view('admin.unauthorized');
  }

}
