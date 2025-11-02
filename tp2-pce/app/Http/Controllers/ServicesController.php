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
    $query = Service::with('category', 'plans');

    if ($request->filled('name')) {
      $query->where('name', 'LIKE', '%' . $request->name . '%');
    }
    if ($request->filled('category_id')) {
      $query->where('category_id', $request->category_id);
    }
    if ($request->filled('status')) {
      $query->where('status', $request->status);
    }

    $services = $query->orderBy('name')->paginate(6);

    $categories = Category::withCount('services')->orderBy('updated_at')->get();

    return view('admin.services.index', compact('services', 'categories'));
  }

  /**
   * Mostrar formulario de creación.
   */
  public function create()
  {
    $categories = Category::orderBy('name')->get();
    return view('admin.services.create', compact('categories'));
  }

  /**
   * Guardar un nuevo servicio.
   */
  public function store(Request $request)
  {
    $validated = $this->validateService($request);

    if ($request->hasFile('image')) {
      $validated['image'] = $this->saveImage($request);
    }

    $service = $this->createService($validated);

    $this->createPlans($service, $validated['plans']);

    return redirect()->route('admin.services.index')
      ->with('success', 'Servicio creado correctamente.');
  }

  /**
   * Mostrar servicio individual.
   */
  public function show(Service $service)
  {
    $service->load('plans', 'category');
    return view('admin.services.show', compact('service'));
  }

  /**
   * Mostrar formulario de edición.
   */
  public function edit(Service $service)
  {
    $categories = Category::orderBy('name')->get();
    $service->load('plans');
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

    $this->syncPlans($service, $validated['plans']);

    return redirect()->route('admin.services.index')->with('success', 'Servicio actualizado correctamente.');
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

    return redirect()->route('admin.services.index')->with('success', 'Servicio eliminado correctamente.');
  }

  // --------- Métodos privados -------------

  private function validateService(Request $request)
  {
    return $request->validate([
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
  }

  private function saveImage(Request $request)
  {
    $path = $request->file('image')->store('img/servicios', 'public');
    return basename($path);
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

  private function createPlans(Service $service, array $plans)
  {
    foreach ($plans as $planData) {
      $service->plans()->create([
        'name' => $planData['name'],
        'price' => $planData['price'],
        'type' => $planData['type'] ?? null,
        'features' => json_encode(
          array_map('trim', explode(',', $planData['features'] ?? ''))
        ),
      ]);
    }
  }

// Puedes usar estos mismos métodos en create()

  private function handleImage(Request $request, ?Service $service = null)
  {
    if ($request->hasFile('image')) {
      // Si hay imagen nueva y hay imagen previa, eliminar la anterior
      if ($service && $service->image && \Storage::disk('public')->exists('img/servicios/' . $service->image)) {
        \Storage::disk('public')->delete('img/servicios/' . $service->image);
      }
      $path = $request->file('image')->store('img/servicios', 'public');
      return basename($path);
    } elseif ($service) {
      return $service->image; // Mantener imagen anterior si no se sube nueva
    }
    return null;
  }

  private function extractServiceFields(array $validated)
  {
    return [
      'name' => $validated['name'],
      'category_id' => $validated['category_id'],
      'status' => $validated['status'] ?? 'Activo',
      'subtitle' => $validated['subtitle'],
      'description' => $validated['description'],
      'conditions' => $validated['conditions'] ?? null,
      'image' => $validated['image'],
    ];
  }

  private function syncPlans(Service $service, array $plans)
  {
    $existingPlanIds = $service->plans()->pluck('id')->toArray();
    $incomingPlanIds = [];

    foreach ($plans as $planData) {
      $features = json_encode(array_map('trim', explode(',', $planData['features'] ?? '')));
      if (!empty($planData['id'])) {
        $plan = $service->plans()->where('id', $planData['id'])->first();
        if ($plan) {
          $plan->update([
            'name' => $planData['name'],
            'price' => $planData['price'],
            'type' => $planData['type'] ?? null,
            'features' => $features,
          ]);
          $incomingPlanIds[] = $plan->id;
        }
      } else {
        $newPlan = $service->plans()->create([
          'name' => $planData['name'],
          'price' => $planData['price'],
          'type' => $planData['type'] ?? null,
          'features' => $features,
        ]);
        $incomingPlanIds[] = $newPlan->id;
      }
    }

    // Eliminar planes que no están en el formulario actual
    $toDelete = array_diff($existingPlanIds, $incomingPlanIds);
    if (count($toDelete) > 0) {
      $service->plans()->whereIn('id', $toDelete)->delete();
    }
  }
}
