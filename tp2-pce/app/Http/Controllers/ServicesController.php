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

    $services = $query->orderBy('id', 'desc')->paginate(6);

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
    $validated = $this->validateService($request);// valida los campos del servicio

    if ($request->hasFile('image')) {
      $validated['image'] = $this->saveImage($request);
    }

    $service = $this->createService($validated);

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
    $image = $service->image; // guardo el nombre antes de borrar
    $storage = Storage::disk('public');
    $path = 'img/servicios/';

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
      'name' => 'required|string|max:255',
      'category_id' => 'required|integer|exists:categories,id',
      'status' => 'nullable|string|max:50',
      'subtitle' => 'required|string|max:255',
      'description' => 'required|string',
      'conditions' => 'nullable|string',
      'image' => 'nullable|image|mimes:webp,jpeg,png|max:5120',
    ]);
  }

  private function saveImage(Request $request): string
  {
    $image = $request->file('image');

    // nombre único + extensión original
    $filename = uniqid('srv_') . '.' . $image->getClientOriginalExtension();

    // guardar en storage/app/public/img/servicios
    $path = $image->storeAs('img/servicios', $filename, 'public');

    // devolver solo el nombre (no la ruta completa)
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


// Puedes usar estos mismos métodos en create()

  private function handleImage(Request $request, ?Service $service = null): ?string
  {
    // Si no se sube imagen, devolvemos la anterior (si existe)
    if (!$request->hasFile('image')) {
      return $service?->image;
    }

    $image = $request->file('image');
    $disk = \Storage::disk('public');
    $path = 'img/servicios/';

    // Si hay una imagen anterior y existe en disco, se elimina
    if ($service && $service->image && $disk->exists($path . $service->image)) {
      $disk->delete($path . $service->image);
    }

    // Generar un nombre único (más seguro que el original)
    $filename = uniqid('srv_') . '.' . $image->getClientOriginalExtension();

    // Guardar imagen en el disco público
    $image->storeAs($path, $filename, 'public');

    return $filename;
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
}
