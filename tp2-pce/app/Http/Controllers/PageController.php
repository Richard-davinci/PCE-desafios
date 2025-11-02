<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    function services()
    {
        return view('pages.services');
    }
    public function viewService()
    {
        return view('pages.viewService');
    }
    public function error404()
    {
      return view('pages.error404');
    }

}
