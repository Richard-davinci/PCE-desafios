<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
  /**
   * Mostrar listado de servicios.
   */
  public function index()
  {
    $services = Service::with('category', 'plans')->orderBy('name')->paginate(6);
    $categories = Category::withCount('services')->orderBy('name')->get();
    return view('services.index', compact('services', 'categories'));
  }

  /**
   * Mostrar formulario de creación.
   */
  public function create()
  {
    $categories = Category::orderBy('name')->get();
    return view('services.create', compact('categories'));
  }

  /**
   * Guardar un nuevo servicio.
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'category_id' => 'required|integer|exists:categories,id',
      'status' => 'nullable|string|max:50',
      'subtitle' => 'required|string|max:255',
      'description' => 'required|string',
      'conditions' => 'nullable|string',
      'image' => 'nullable|image|mimes:webp,jpeg,png|max:5120',
      'plans' => 'required|array|min:1',
      'plans.*.name' => 'required|string|max:255',
      'plans.*.price' => 'required|numeric|min:0',
      'plans.*.type' => 'nullable|string|max:255',
      'plans.*.features' => 'nullable|string|max:500',
    ]);

    // Guardar imagen si se subió
    if ($request->hasFile('image')) {
      $path = $request->file('image')->store('img/servicios', 'public');
      $validated['image'] = basename($path);
    }

    // Crear servicio
    $service = Service::create([
      'name' => $validated['name'],
      'category_id' => $validated['category_id'],
      'status' => $validated['status'] ?? 'Activo',
      'subtitle' => $validated['subtitle'],
      'description' => $validated['description'],
      'conditions' => $validated['conditions'] ?? null,
      'image' => $validated['image'] ?? null,
    ]);

    // Crear planes asociados
    foreach ($validated['plans'] as $planData) {
      $service->plans()->create([
        'name' => $planData['name'],
        'price' => $planData['price'],
        'type' => $planData['type'] ?? null,
        'features' => json_encode(
          array_map('trim', explode(',', $planData['features'] ?? ''))
        ),
      ]);
    }

    return redirect()->route('services.index')->with('success', 'Servicio creado correctamente.');
  }

  /**
   * Mostrar servicio individual.
   */
  public function show(Service $service)
  {
    $service->load('plans', 'category');
    return view('services.show', compact('service'));
  }

  /**
   * Mostrar formulario de edición.
   */
  public function edit(Service $service)
  {
    $categories = Category::orderBy('name')->get();
    $service->load('plans');
    return view('services.edit', compact('service', 'categories'));
  }

  /**
   * Actualizar servicio existente.
   */
  public function update(Request $request, Service $service)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'category_id' => 'required|integer|exists:categories,id',
      'status' => 'nullable|string|max:50',
      'subtitle' => 'required|string|max:255',
      'description' => 'required|string',
      'conditions' => 'nullable|string',
      'image' => 'nullable|image|mimes:webp,jpeg,png|max:5120',
      'plans' => 'required|array|min:1',
      'plans.*.id' => 'nullable|integer|exists:plans,id',
      'plans.*.name' => 'required|string|max:255',
      'plans.*.price' => 'required|numeric|min:0',
      'plans.*.type' => 'nullable|string|max:255',
      'plans.*.features' => 'nullable|string|max:500',
    ]);

    // Manejo de imagen (si se sube una nueva, borrar la anterior)
    if ($request->hasFile('image')) {
      if ($service->image && Storage::disk('public')->exists('img/servicios/' . $service->image)) {
        Storage::disk('public')->delete('img/servicios/' . $service->image);
      }
      $path = $request->file('image')->store('img/servicios', 'public');
      $validated['image'] = basename($path);
    } else {
      $validated['image'] = $service->image;
    }

    // Actualizar servicio
    $service->update([
      'name' => $validated['name'],
      'category_id' => $validated['category_id'],
      'status' => $validated['status'] ?? 'Activo',
      'subtitle' => $validated['subtitle'],
      'description' => $validated['description'],
      'conditions' => $validated['conditions'] ?? null,
      'image' => $validated['image'],
    ]);

    // Actualizar o crear planes
    $existingPlanIds = $service->plans()->pluck('id')->toArray();
    $incomingPlanIds = [];

    foreach ($validated['plans'] as $planData) {
      if (!empty($planData['id'])) {
        $plan = Plan::find($planData['id']);
        if ($plan) {
          $plan->update([
            'name' => $planData['name'],
            'price' => $planData['price'],
            'type' => $planData['type'] ?? null,
            'features' => json_encode(array_map('trim', explode(',', $planData['features'] ?? ''))),
          ]);
          $incomingPlanIds[] = $plan->id;
        }
      } else {
        $newPlan = $service->plans()->create([
          'name' => $planData['name'],
          'price' => $planData['price'],
          'type' => $planData['type'] ?? null,
          'features' => json_encode(array_map('trim', explode(',', $planData['features'] ?? ''))),
        ]);
        $incomingPlanIds[] = $newPlan->id;
      }
    }

    // Eliminar planes que no estén en el formulario
    $toDelete = array_diff($existingPlanIds, $incomingPlanIds);
    Plan::whereIn('id', $toDelete)->delete();

    return redirect()->route('services.index')->with('success', 'Servicio actualizado correctamente.');
  }

  /**
   * Eliminar un servicio.
   */
  public function destroy(Service $service)
  {
    if ($service->image && Storage::disk('public')->exists('img/servicios/' . $service->image)) {
      Storage::disk('public')->delete('img/servicios/' . $service->image);
    }

    $service->plans()->delete();
    $service->delete();

    return redirect()->route('services.index')->with('success', 'Servicio eliminado correctamente.');
  }
}
