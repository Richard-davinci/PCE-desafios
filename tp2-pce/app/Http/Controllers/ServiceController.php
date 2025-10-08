<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
    $categories = Category::orderBy('name')->get();
    return view('services.create', compact('categories'));

  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    try {
      // todo el código de guardado


      // 1. Validación de todos los campos
      $camposValidados = $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|integer|exists:categories,id',
        'status' => 'required|string|max:50',
        'subtitle' => 'required|string|max:255',
        'description' => 'required|string',
        'conditions' => 'nullable|string',
        'cover_image' => 'required|image|mimes:webp,jpeg,png|max:2048',
        'thumb_image' => 'required|image|mimes:webp,jpeg,png|max:2048',
        'plans' => 'required|array|min:1',
        'plans.*.name' => 'required|string|max:255',
        'plans.*.price' => 'required|numeric|min:0',
        'plans.*.type' => 'nullable|string|max:255',
        'plans.*.features' => 'nullable|string|max:500',
      ],
        [
          'name.required' => 'El campo nombre es obligatorio.',
        ]
      );

      // 2. Guardar imágenes en /storage/app/public/img/servicios
      $rutaCover = $request->file('cover_image')->store('img/servicios', 'public');
      $rutaThumb = $request->file('thumb_image')->store('img/servicios', 'public');

      // 3. Crear el servicio principal
      $services = Service::create([
        'name' => $camposValidados['name'],
        'category_id' => $camposValidados['category_id'],
        'status' => $camposValidados['status'],
        'subtitle' => $camposValidados['subtitle'],
        'description' => $camposValidados['description'],
        'conditions' => $camposValidados['conditions'] ?? null,
        'cover_image' => $rutaCover,
        'thumb_image' => $rutaThumb,
      ]);

      // 4. Crear los planes asociados
      foreach ($camposValidados['plans'] as $planData) {
        $services->plans()->create([
          'name' => $planData['name'],
          'price' => $planData['price'],
          'type' => $planData['type'] ?? null,
          'features' => json_encode(
            array_map('trim', explode(',', $planData['features'] ?? ''))
          ),
        ]);
      }

      // 5. Redirigir con mensaje de éxito
      return redirect()
        ->route('services.index')
        ->with('success', 'Servicio y planes creados correctamente.');
    } catch (\Throwable $e) {
      dd($e->getMessage());
    }
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
