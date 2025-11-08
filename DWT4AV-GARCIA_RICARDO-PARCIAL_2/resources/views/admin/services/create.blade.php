@extends('layouts.app')

@section('title', 'Crear servicio')

@section('content')

  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container mb-4">
      <h1 id="pageTitle" class="fs-1 font-bankgothic fw-bold mb-1">Crear servicio</h1>
      <p class="text-secondary mb-0">Completá los datos del servicio y agregá uno o más planes.</p>
    </div>
  </section>
  <section class="container">
    <x-breadcrumb
      :items="[['label' => 'Servicios',   'route' => 'admin.services.index'],  ['label' => 'crear-servicio']]"
      separator="›"/>
  </section>
  <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data"
        class="">
    @csrf
    <section class="my-3 py-4 container bg-azul text-light p-4 rounded-3 shadow-sm">
      <h2 id="datosTitle" class="fs-4 font-bankgothic text-turquesa mb-3">Datos del servicio</h2>
      <div class="row">
        {{-- Nombre --}}
        <div class="col-sm-6 col-lg-4 mb-3">
          <label for="name" class="form-label">Nombre del servicio</label>
          <input type="text" name="name" id="name" class="form-control" required>
          @error('name')
          <div class="alert alert-danger mt-1">{{ $message }}</div>
          @enderror
        </div>

        {{-- Categoría --}}
        <div class="col-sm-6 col-lg-4 mb-3">
          <label for="category_id" class="form-label">Categoría</label>
          <select name="category_id" id="category_id" class="form-select" required>
            <option value="">Seleccionar categoría...</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
          @error('category_id')
          <div class="alert alert-danger mt-1">{{ $message }}</div>
          @enderror
        </div>

        {{-- Estado --}}
        <div class="col-sm-6 col-lg-4 mb-3">
          <label for="status" class="form-label">Estado</label>
          <select name="status" id="status" class="form-select">
            <option value="Activo" selected>Activo</option>
            <option value="Pausado">Pausado</option>
            <option value="Discontinuado">Discontinuado</option>
          </select>
          @error('status')
          <div class="alert alert-danger mt-1">{{ $message }}</div>
          @enderror
        </div>

        {{-- Subtítulo --}}
        <div class="col-sm-6 col-lg-4 mb-3">
          <label for="subtitle" class="form-label">Subtítulo</label>
          <input type="text" name="subtitle" id="subtitle" class="form-control" required>
          @error('subtitle')
          <div class="alert alert-danger mt-1">{{ $message }}</div>
          @enderror
        </div>

        {{-- Imagen principal --}}
        <div class="col-sm-6 col-lg-4 mb-3">
          <label for="cover_image" class="form-label">Imagen principal</label>
          <input type="file" name="cover_image" id="cover_image" class="form-control" accept=".webp,.jpeg,.png">
          @error('cover_image')
          <div class="alert alert-danger mt-1">{{ $message }}</div>
          @enderror
        </div>
      </div>

      {{-- Descripción --}}
      <div class="col-12 mb-3">
        <label for="description" class="form-label">Descripción</label>
        <textarea name="description" id="description" rows="4" class="form-control" required></textarea>
        @error('description')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
      </div>

      {{-- Condiciones --}}
      <div class="col-12 mb-3">
        <label for="conditions" class="form-label">Condiciones</label>
        <textarea name="conditions" id="conditions" rows="3" class="form-control"
                  placeholder="Ej: Soporte técnico, Renovación automática, Cancelación gratuita"></textarea>
        <small class="text-secondary">Separá cada condición con una coma.</small>
        @error('conditions')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="d-flex justify-content-end gap-2 w-auto">
        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-turquesa">
          <i class="bi bi-arrow-left"></i> Volver
        </a>
        <button type="submit" class="btn btn-turquesa">
          <i class="bi bi-save"></i> Guardar servicio
        </button>
      </div>
    </section>
  </form>

@endsection
