@extends('layouts.app')

@section('title', 'Editar servicio')

@section('content')

  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container mb-4">
      <h1 class="fs-1 font-bankgothic fw-bold mb-1">Editar servicio</h1>
      <p class="text-secondary mb-0">Modificá los datos del servicio y gestioná sus planes.</p>
    </div>
  </section>
  <section class="container">
    <x-breadcrumb :items="[['label' => 'Servicios',   'route' => 'admin.services.index'],  ['label' => 'editar-servicio']]"
                  separator="›"/>
  </section>

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
          @error('name') <div class="alert alert-danger mt-1">{{ $message }}</div> @enderror
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
          @error('category_id') <div class="alert alert-danger mt-1">{{ $message }}</div> @enderror
        </div>

        {{-- Estado --}}
        <div class="col-sm-6 col-lg-4 mb-3">
          <label for="status" class="form-label">Estado</label>
          <select name="status" id="status" class="form-select">
            <option value="Activo" {{ $service->status === 'Activo' ? 'selected' : '' }}>Activo</option>
            <option value="Pausado" {{ $service->status === 'Pausado' ? 'selected' : '' }}>Pausado</option>
            <option value="Discontinuado" {{ $service->status === 'Discontinuado' ? 'selected' : '' }}>Discontinuado</option>
          </select>
        </div>

        {{-- Subtítulo --}}
        <div class="col-sm-6 col-lg-4 mb-3">
          <label for="subtitle" class="form-label">Subtítulo</label>
          <input type="text" name="subtitle" id="subtitle" class="form-control" value="{{ old('subtitle', $service->subtitle) }}">
        </div>

        {{-- Imagen del servicio --}}
        <div class="col-sm-6 col-lg-4 mb-3">
          <label for="image" class="form-label">Imagen del servicio</label>
          @if($service->image)
            <div class="mb-2">
              <img src="{{ asset('storage/img/servicios/' . $service->image) }}" alt="Imagen actual" class="img-thumbnail" style="max-width: 150px;">
            </div>
          @endif
          <input type="file" name="image" id="image" class="form-control">
          <small class="text-secondary">Si no seleccionás ninguna imagen, se mantendrá la actual.</small>
          @error('image') <div class="alert alert-danger mt-1">{{ $message }}</div> @enderror
        </div>
      </div>

      {{-- Descripción --}}
      <div class="col-12 mb-3">
        <label for="description" class="form-label">Descripción</label>
        <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $service->description) }}</textarea>
      </div>

      {{-- Condiciones --}}
      <div class="col-12 mb-3">
        <label for="conditions" class="form-label">Condiciones</label>
        <textarea name="conditions" id="conditions" rows="3" class="form-control">
          {{ old('conditions', is_array($service->conditions) ? implode(', ', $service->conditions) : $service->conditions) }}
        </textarea>
      </div>

      {{-- Planes --}}
      <h4 class="font-bankgothic text-turquesa mt-5 mb-3">Planes del servicio</h4>
      <div id="plans-container">
        @foreach($service->plans as $index => $plan)
          <div class="plan-item border rounded-3 p-3 mb-3">
            <input type="hidden" name="plans[{{ $index }}][id]" value="{{ $plan->id }}">
            <div class="row g-2">
              <div class="col-lg-4">
                <label class="form-label">Nombre del plan</label>
                <input type="text" name="plans[{{ $index }}][name]" class="form-control" value="{{ $plan->name }}">
              </div>
              <div class="col-lg-3">
                <label class="form-label">Precio (AR$)</label>
                <input type="number" name="plans[{{ $index }}][price]" class="form-control" step="0.01" value="{{ $plan->price }}">
              </div>
              <div class="col-lg-3">
                <label class="form-label">Tipo</label>
                <select name="plans[{{ $index }}][type]" class="form-select">
                  <option value="único" {{ $plan->type === 'único' ? 'selected' : '' }}>Único</option>
                  <option value="mensual" {{ $plan->type === 'mensual' ? 'selected' : '' }}>Mensual</option>
                  <option value="anual" {{ $plan->type === 'anual' ? 'selected' : '' }}>Anual</option>
                </select>
              </div>
              <div class="col-lg-12 mt-2">
                <label class="form-label">Características (separadas por coma)</label>
                <input type="text" name="plans[{{ $index }}][features]" class="form-control"
                       value="{{ is_array($plan->features) ? implode(',', $plan->features) : implode(',', json_decode($plan->features ?? '[]', true)) }}">
              </div>
            </div>
            <button type="button" class="btn btn-danger btn-sm mt-3 removePlan">
              <i class="bi bi-trash"></i> Eliminar plan
            </button>
          </div>
        @endforeach
      </div>

      {{-- Botón agregar plan --}}
      <div class="d-flex justify-content-start mb-4">
        <button type="button" id="addPlan" class="btn btn-outline-turquesa">
          <i class="bi bi-plus-circle"></i> Agregar otro plan
        </button>
      </div>

      {{-- Botones finales --}}
      <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-light">
          <i class="bi bi-arrow-left"></i> Volver
        </a>
        <button type="submit" class="btn btn-turquesa">
          <i class="bi bi-save"></i> Actualizar servicio
        </button>
      </div>
    </form>
  </section>

  {{-- Script duplicar/eliminar planes --}}
  @push('scripts')
    <script>
      let planIndex = {{ $service->plans->count() }};

      document.getElementById('addPlan').addEventListener('click', function () {
        const container = document.getElementById('plans-container');

        const newPlan = document.createElement('div');
        newPlan.classList.add('plan-item', 'border', 'rounded-3', 'p-3', 'mb-3');

        newPlan.innerHTML = `
          <div class="row g-2">
            <div class="col-lg-4">
              <label class="form-label">Nombre del plan</label>
              <input type="text" name="plans[${planIndex}][name]" class="form-control">
            </div>
            <div class="col-lg-3">
              <label class="form-label">Precio (AR$)</label>
              <input type="number" name="plans[${planIndex}][price]" class="form-control" step="0.01">
            </div>
            <div class="col-lg-3">
              <label class="form-label">Tipo</label>
              <select name="plans[${planIndex}][type]" class="form-select">
                <option value="único">Único</option>
                <option value="mensual">Mensual</option>
                <option value="anual">Anual</option>
              </select>
            </div>
            <div class="col-lg-12 mt-2">
              <label class="form-label">Características (separadas por coma)</label>
              <input type="text" name="plans[${planIndex}][features]" class="form-control" placeholder="Hosting, Dominio, Soporte técnico">
            </div>
          </div>
          <button type="button" class="btn btn-danger btn-sm mt-3 removePlan">
            <i class="bi bi-trash"></i> Eliminar plan
          </button>
        `;

        container.appendChild(newPlan);
        planIndex++;
      });

      document.addEventListener('click', function (e) {
        if (e.target.closest('.removePlan')) {
          if (confirm('¿Estás seguro de eliminar este plan?')) {
            e.target.closest('.plan-item').remove();
          }
        }
      });
    </script>
  @endpush

@endsection
