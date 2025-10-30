<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    function service()
    {
        return view('pages.service');
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
