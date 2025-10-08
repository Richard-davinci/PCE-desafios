<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
//    $services = Service::all();

    $services = Service::paginate(3);

    return view('services.index', compact('services'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('services.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $services = Service::create($request->only([
      'name', 'category', 'status', 'subtitle', 'description', 'conditions', 'cover_image', 'thumb_image'
    ]));

    if ($request->has('plans')) {
      foreach ($request->plans as $planData) {
        $services->plans()->create([
          'name' => $planData['name'],
          'price' => $planData['price'],
          'type' => $planData['type'] ?? null,
          'features' => json_encode(
            array_map('trim', explode(',', $planData['features'] ?? ''))
          ),
        ]);
      }
    }

    return redirect()->route('service.index')->with('success', 'Servicio creado con éxito');
  }


  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    return view('services.show');
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    return view('services.edit');
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
