<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Service;

class PageController extends Controller
{
  public function index()
  {
    // Trae los últimos 3 servicios activos
    $services = Service::where('status', 'Activo')
      ->orderBy('created_at', 'desc')
      ->take(3)
      ->get();

    return view('pages.index', compact('services'));
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
    $services = Service::with('category', 'plans')->where('status', 'Activo')->get();

    return view('pages.services', compact('services'));
  }

  public function viewService(Service $service)
  {
    $service->load(['plans' => fn($query) => $query->orderBy('price')]);
    $service->load('category');
    return view('pages.viewService', compact('service'));
  }

  public function error404()
  {
    return view('pages.error404');
  }

}
