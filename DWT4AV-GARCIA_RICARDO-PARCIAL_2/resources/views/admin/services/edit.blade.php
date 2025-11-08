@extends('layouts.app')

@section('title', 'Editar servicio')

@section('content')

  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container mb-4">
      <h1 class="fs-1 font-bankgothic fw-bold mb-1">Editar servicio</h1>
      <p class="text-secondary mb-0">Modificá los datos del servicio y gestioná sus planes.</p>
    </div>
  </section>
  <div class="container">
    <x-breadcrumb
      :items="[['label' => 'Servicios',   'route' => 'admin.services.index'],  ['label' => 'editar-servicio']]"
      separator="›"/>
  </div>

  <section class="mt-3 py-4 container">
    <form method="POST" action="{{ route('admin.services.update', $service->id) }}" enctype="multipart/form-data"
          class="bg-azul text-light p-4 rounded-3 shadow-sm">
      @csrf
      @method('PUT')

      <h2 class="fs-4 font-bankgothic text-turquesa mb-3">Datos principales</h2>
      <div class="row">
        {{-- Nombre --}}
        <div class="col-sm-6 col-lg-4 mb-3">
          <label for="name" class="form-label">Nombre del servicio</label>
          <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $service->name) }}">
          @error('name')
          <div class="alert alert-danger mt-1">{{ $message }}</div> @enderror
        </div>

        {{-- Categoría --}}
        <div class="col-sm-6 col-lg-4 mb-3">
          <label for="category_id" class="form-label">Categoría</label>
          <select name="category_id" id="category_id" class="form-select">
            <option value="">Seleccionar categoría...</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}" {{ $service->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
              </option>
            @endforeach
          </select>
          @error('category_id')
          <div class="alert alert-danger mt-1">{{ $message }}</div> @enderror
        </div>

        {{-- Estado --}}
        <div class="col-sm-6 col-lg-4 mb-3">
          <label for="status" class="form-label">Estado</label>
          <select name="status" id="status" class="form-select">
            <option value="Activo" {{ $service->status === 'Activo' ? 'selected' : '' }}>Activo</option>
            <option value="Pausado" {{ $service->status === 'Pausado' ? 'selected' : '' }}>Pausado</option>
            <option value="Discontinuado" {{ $service->status === 'Discontinuado' ? 'selected' : '' }}>Discontinuado
            </option>
          </select>
        </div>

        {{-- Subtítulo --}}
        <div class="col-sm-6 col-lg-4 mb-3">
          <label for="subtitle" class="form-label">Subtítulo</label>
          <input type="text" name="subtitle" id="subtitle" class="form-control"
                 value="{{ old('subtitle', $service->subtitle) }}">
        </div>

        {{-- Imagen del servicio --}}
        <div class="col-sm-6 col-lg-4 mb-3">0
          <label for="image" class="form-label">Imagen del servicio</label>
          <input type="file" name="image" id="image" class="form-control">
          <small class="text-secondary">Si no seleccionás ninguna imagen, se mantendrá la actual.</small>
          @error('image')
          <div class="alert alert-danger mt-1">{{ $message }}</div> @enderror
        </div>
        @if($service->image)
          <div class="col-sm-6 col-lg-4 mb-3">
            <label class="form-label">Imagen del servicio actual</label>
            <img src="{{ asset('storage/img/services/' . $service->image) }}"
                 alt="{{ $service->name }}" class="img-thumbnail" style="max-width: 150px;">
          </div>
        @endif
      </div>

      {{-- Descripción --}}
      <div class="col-12 mb-3">
        <label for="description" class="form-label">Descripción</label>
        <textarea name="description" id="description" rows="4"
                  class="form-control">{{ old('description', $service->description) }}</textarea>
      </div>

      {{-- Condiciones --}}
      <div class="col-12 mb-3">
        <label for="conditions" class="form-label">Condiciones</label>
        <textarea name="conditions" id="conditions" rows="3" class="form-control">
          {{ old('conditions', is_array($service->conditions) ? implode(', ', $service->conditions) : $service->conditions) }}
        </textarea>
      </div>

      {{-- Botones finales --}}
      <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-turquesa">
          <i class="bi bi-arrow-left"></i> Volver
        </a>
        <button type="submit" class="btn btn-turquesa">
          <i class="bi bi-save"></i> Guardar servicio
        </button>
      </div>
    </form>
  </section>

@endsection
