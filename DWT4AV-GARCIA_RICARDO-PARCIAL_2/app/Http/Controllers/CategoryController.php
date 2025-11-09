<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  public function index()
  {
    $categories = Category::withCount('services')->paginate(6);
    return view('admin.categories.index', compact('categories'));
  }

  public function create()
  {
    return view('admin.categories.create');
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:100|unique:categories,name',
    ], [
      'name.required' => 'El nombre de la categoría es obligatorio.',
      'name.string'   => 'El nombre debe contener solo texto válido.',
      'name.max'      => 'El nombre no puede superar los 100 caracteres.',
      'name.unique'   => 'Ya existe una categoría con este nombre.',
    ]);

    Category::create([
      'name' => $validated['name'],
    ]);

    return redirect()
      ->route('admin.categories.index')
      ->with('success', 'Categoría creada correctamente.');
  }


  public function edit(Category $category)
  {
    return view('admin.categories.edit', compact('category'));
  }

  public function update(Request $request, Category $category)
  {
    $request->validate([
      'name' => 'required|unique:categories,name,' . $category->id . '|max:255',
    ]);

    $category->update([
      'name' => $request->name,
    ]);

    return redirect()->route('admin.categories.index')->with('success', 'Categoría actualizada correctamente.');
  }

  public function destroy(Category $category)
  {
    if ($category->services()->exists()) {
      return back()->with('error', 'No se puede eliminar la categoría porque tiene servicios asociados.');
    }

    $category->delete();

    return back()->with('success', 'Categoría eliminada correctamente.');
  }

}
