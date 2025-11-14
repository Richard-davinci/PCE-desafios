@extends('layouts.app')
@section('title', 'Editar servicio')
@section('content')

  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container mb-4">
      <h1 id="pageTitle" class="fs-1 font-bankgothic fw-bold mb-1">Editar servicio</h1>
      <p class="text-blanco mb-0">
        Modificá los datos del servicio y actualizá su información general.
      </p>
    </div>
  </section>

  <div class="container">
    <x-breadcrumb
      :items="[
        ['label' => 'Servicios', 'route' => 'admin.services.index'],
        ['label' => 'editar-servicio']
      ]"
      separator="›"
    />
  </div>

  <form method="POST"
        action="{{ route('admin.services.update', $service->id) }}"
        enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <section class="my-3 py-4 container bg-azul text-light p-4 rounded-3 shadow-sm">
      <h2 id="datosTitle" class="fs-4 font-bankgothic text-turquesa mb-3">
        Datos del servicio
      </h2>

      <div class="row">

        {{-- Nombre --}}
        <div class="col-sm-6 col-lg-4 mb-3">
          <label for="name" class="form-label">
            Nombre del servicio *
          </label>
          <input type="text" name="name" id="name"
                 class="form-control @error('name') is-invalid @enderror"
                 placeholder="Nombre completo del servicio"
                 value="{{ old('name', $service->name) }}">
          @error('name')
          <x-alert type="danger" :message="$message" small/>
          @enderror
        </div>

        {{-- Categoría --}}
        <div class="col-sm-6 col-lg-4 mb-3">
          <label for="category_id" class="form-label">Categoría *</label>
          <select name="category_id"
                  id="category_id"
                  class="form-select @error('category_id') is-invalid @enderror">
            <option value="">Seleccionar categoría</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}"
                {{ old('category_id', $service->category_id) == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
              </option>
            @endforeach
          </select>
          @error('category_id')
          <x-alert type="danger" :message="$message" small/>
          @enderror
        </div>

        {{-- Estado --}}
        <div class="col-sm-6 col-lg-4 mb-3">
          <label for="status" class="form-label">Estado</label>
          @php
            $currentStatus = old('status', $service->status ?? 'Borrador');
          @endphp
          <select name="status"
                  id="status"
                  class="form-select @error('status') is-invalid @enderror">
            <option value="Activo" {{ $currentStatus === 'Activo' ? 'selected' : '' }}>Activo</option>
            <option value="Pausado" {{ $currentStatus === 'Pausado' ? 'selected' : '' }}>Pausado</option>
            <option value="Borrador" {{ $currentStatus === 'Borrador' ? 'selected' : '' }}>Borrador</option>
          </select>
          @error('status')
          <x-alert type="danger" :message="$message" small/>
          @enderror
        </div>

        {{-- Subtítulo --}}
        <div class="col-sm-6 col-lg-4 mb-3">
          <label for="subtitle" class="form-label">Subtítulo *</label>
          <input type="text"
                 name="subtitle"
                 id="subtitle"
                 class="form-control @error('subtitle') is-invalid @enderror"
                 value="{{ old('subtitle', $service->subtitle) }}"
                 placeholder="Breve descripción del servicio">
          @error('subtitle')
          <x-alert type="danger" :message="$message" small/>
          @enderror
        </div>

        {{-- Imagen nueva --}}
        <div class="col-sm-6 col-lg-4 mb-3">
          <label for="image" class="form-label">Imagen del servicio</label>
          <input type="file"
                 name="image"
                 id="image"
                 class="form-control @error('image') is-invalid @enderror"
                 accept=".webp,.jpeg,.jpg,.png">
          <small class="text-blanco d-block">
            Si no seleccionás ninguna imagen, se mantendrá la actual.
          </small>
          @error('image')
          <x-alert type="danger" :message="$message" small/>
          @enderror
        </div>

        {{-- Imagen actual --}}
        <div class="col-sm-6 col-lg-4 mb-3">
          <label class="form-label">Imagen actual</label>
          <img src="{{ asset('storage/img/services/' . ($service->image ?? 'default.webp')) }}"
               alt="{{ $service->name }}"
               class="img-thumbnail"
               style="max-width: 70px;">
        </div>

        {{-- Descripción --}}
        <div class="col-12 col-lg-6 mb-3">
          <label for="description" class="form-label">Descripción *</label>
          <textarea name="description"
                    id="description"
                    rows="3"
                    placeholder="Escriba una descripcion completa del servico"
                    class="form-control @error('description') is-invalid @enderror">{{ old('description', $service->description) }}</textarea>
          @error('description')
          <x-alert type="danger" :message="$message" small/>
          @enderror
        </div>

        {{-- Condiciones --}}
        <div class="col-12 col-lg-6 mb-3">
          <label for="conditions" class="form-label">Condiciones</label>
          <textarea name="conditions"
                    id="conditions"
                    rows="3"
                    class="form-control @error('conditions') is-invalid @enderror"
                    placeholder="Separá cada condición con una coma. Ej: Soporte técnico, Renovación automática, Cancelación gratuita">{{ old('conditions', $service->conditions) }}</textarea>
          <small class="text-blanco">Separá cada condición con una coma.</small>
          @error('conditions')
          <x-alert type="danger" :message="$message" small/>
          @enderror
        </div>

      </div>

      <div class="d-flex justify-content-end gap-2 w-auto">
        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-turquesa">
          <i class="fa-solid fa-arrow-left"></i> Volver
        </a>
        <button type="submit" class="btn btn-turquesa">
          <i class="fa-solid fa-floppy-disk"></i> Guardar cambios
        </button>
      </div>

    </section>
  </form>

@endsection
