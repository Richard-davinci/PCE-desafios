<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{
  /**
   * Mostrar listado de servicios.
   */
  public function index(Request $request)
  {
    $query = Service::with('category', 'plans')
      ->withCount('subscriptions');

    if ($request->filled('name')) {
      $query->where('name', 'LIKE', '%' . $request->name . '%');
    }
    if ($request->filled('category_id')) {
      $query->where('category_id', $request->category_id);
    }
    if ($request->filled('status')) {
      $query->where('status', $request->status);
    }

    //filtro para planes
    if ($request->filled('plan_mode')) {
      switch ($request->plan_mode) {
        case 'none':
          // Servicios sin ningún plan
          $query->whereDoesntHave('plans');
          break;

        case 'unico':
          // Servicios que tienen al menos un plan tipo 'único'
          $query->whereHas('plans', function ($q) {
            $q->where('type', 'único');
          });
          break;

        case 'mensual':
          // Servicios que tienen planes mensuales
          $query->whereHas('plans', function ($q) {
            $q->where('type', 'mensual');
          });
          break;
      }
    }

    $services = $query
      ->orderByRaw("FIELD(status, 'Borrador', 'Pausado', 'Activo')")
      ->orderBy('name', 'asc')
      ->paginate(6);


    $categories = Category::withCount('services')->orderBy('updated_at')->get();

    return view('admin.services.index', compact('services', 'categories'));
  }

  public function create()
  {
    $categories = Category::orderBy('name')->get();
    return view('admin.services.create', compact('categories'));
  }

  public function store(Request $request)
  {
    $validated = $this->validateService($request);

    $imageName = $this->handleImage($request, null);

    if ($imageName) {
      $validated['image'] = $imageName;
    }

    $service = $this->createService($validated);

    return redirect()
      ->route('admin.services.index')
      ->with('success', 'Servicio creado correctamente.');
  }


  /**
   * Mostrar servicio individual.
   */
  public function show(Service $service)
  {
    // Plan único
    $uniquePlan = $service->plans->firstWhere('type', 'único');

    // Planes mensuales/anuales agrupados por nombre
    $monthlyPlans = $service->plans
      ->where('type', 'mensual')
      ->sortBy('price')
      ->keyBy('name'); // Básico, Pro, Empresarial

    $annualPlans = $service->plans
      ->where('type', 'anual')
      ->sortBy('price')
      ->keyBy('name');

    $hasMonthly = $monthlyPlans->isNotEmpty();

    $service->load('plans', 'category');
    return view('admin.services.show', compact('service','uniquePlan','monthlyPlans','annualPlans','hasMonthly'));
  }

  /**
   * Mostrar formulario de edición.
   */
  public function edit(Service $service)
  {
    $categories = Category::orderBy('name')->get();
    $service->load(['category', 'plans']);
    return view('admin.services.edit', compact('service', 'categories'));
  }

  /**
   * Actualizar servicio existente.
   */
  public function update(Request $request, Service $service)
  {
    $validated = $this->validateService($request);

    $validated['image'] = $this->handleImage($request, $service);

    $service->update($this->extractServiceFields($validated));

    return redirect()->route('admin.services.index')->with('success', 'Servicio actualizado correctamente.');
  }

  /**
   * Eliminar un servicio.
   */
  public function destroy(Service $service)
  {
    if ($service->subscriptions()->exists()) {
      return back()->with('error', 'No podés eliminar este servicio porque tiene suscripciones activas.');
    }

    $image = $service->image; // guardo el nombre antes de borrar
    $storage = Storage::disk('public');
    $path = 'img/services/';

    if ($image && $storage->exists($path . $image)) {
      $storage->delete($path . $image);
    }

    $service->plans()->delete();
    $service->delete();

    return redirect()->route('admin.services.index')->with('success', 'Servicio eliminado correctamente.');
  }

  // --------- Métodos privados -------------

  private function validateService(Request $request)
  {
    return $request->validate([
      'name' => 'required|string|min:3|max:100',
      'category_id' => 'required|integer|exists:categories,id',
      'subtitle' => 'required|string|min:10|max:150',
      'description' => 'required|string|min:20|max:2000',
      'conditions' => 'nullable|string|max:2000',
      'image' => 'nullable|image|mimes:webp,jpeg,png|max:2048',
      'status' => 'required|in:Activo,Borrador,Pausado',

    ], [
      //Nombre
      'name.required' => 'El nombre del servicio es obligatorio.',
      'name.string' => 'El nombre debe contener solo texto válido.',
      'name.min' => 'El nombre debe tener al menos 3 caracteres.',
      'name.max' => 'El nombre no puede superar los 100 caracteres.',

      //Categoría
      'category_id.required' => 'Debe seleccionar una categoría.',
      'category_id.integer' => 'El identificador de categoría no es válido.',
      'category_id.exists' => 'La categoría seleccionada no existe o no es válida.',

      //Subtítulo
      'subtitle.required' => 'El subtítulo es obligatorio.',
      'subtitle.string' => 'El subtítulo debe ser texto válido.',
      'subtitle.min' => 'El subtítulo debe tener al menos 10 caracteres.',
      'subtitle.max' => 'El subtítulo no puede superar los 150 caracteres.',

      // Descripción
      'description.required' => 'La descripción del servicio es obligatoria.',
      'description.string' => 'La descripción debe contener texto válido.',
      'description.min' => 'La descripción debe tener al menos 20 caracteres.',
      'description.max' => 'La descripción no puede superar los 2000 caracteres.',

      // Condiciones
      'conditions.string' => 'Las condiciones deben contener texto válido.',
      'conditions.max' => 'Las condiciones no pueden superar los 2000 caracteres.',

      // Imagen
      'image.image' => 'El archivo seleccionado debe ser una imagen válida.',
      'image.mimes' => 'La imagen debe estar en formato WEBP, JPEG o PNG.',
      'image.max' => 'La imagen no debe superar los 5 MB de tamaño.',
    ]);
  }

  private function createService(array $data)
  {
    return Service::create([
      'name' => $data['name'],
      'category_id' => $data['category_id'],
      'status' => $data['status'] ?? 'Activo',
      'subtitle' => $data['subtitle'],
      'description' => $data['description'],
      'conditions' => $data['conditions'] ?? null,
      'image' => $data['image'] ?? null,
    ]);
  }

  private function handleImage(Request $request, ?Service $service = null): string
  {
    $disk = Storage::disk('public');
    $path = 'img/services/';

    // Si NO se sube nueva imagen:
    if (!$request->hasFile('image')) {
      return $service?->image ?? '';
    }

    // Si se sube una nueva imagen:
    $image = $request->file('image');

    // Si hay una imagen anterior, la borra
    if ($service && $service->image && $disk->exists($path . $service->image)) {
      $disk->delete($path . $service->image);
    }

    // Guarda la nueva imagen
    $filename = uniqid('srv_') . '.' . $image->getClientOriginalExtension();
    $image->storeAs($path, $filename, 'public');

    return $filename;
  }

  private function extractServiceFields(array $validated): array
  {
    return [
      'name' => $validated['name'],
      'category_id' => $validated['category_id'],
      'status' => $validated['status'],
      'subtitle' => $validated['subtitle'],
      'description' => $validated['description'],
      'conditions' => $validated['conditions'] ?? null,
      'image' => !empty($validated['image'])
        ? $validated['image']
        : 'default.webp',
    ];
  }
}
