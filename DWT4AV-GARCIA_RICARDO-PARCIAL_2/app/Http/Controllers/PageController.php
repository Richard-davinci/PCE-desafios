<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

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

  public function services(Request $request)
  {

    $validated = $request->validate(['name' => ['nullable', 'string', 'max:100'],]);

    $query = Service::query()->where('status', 'Activo');

    if (!empty($validated['name'])) {
      $name = trim($validated['name']);
      $query->where('name', 'LIKE', "%{$name}%");

    }

    $services = $query->orderBy('name', 'asc')->paginate(6)->withQueryString();

    return view('pages.services', [
      'services' => $services,
      'name' => $validated['name'] ?? '',
    ]);
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
