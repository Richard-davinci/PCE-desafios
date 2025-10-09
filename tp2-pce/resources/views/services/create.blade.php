@extends('layouts.admin')

@section('title', 'Crear servicio')

@section('content')

  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container mb-4">
      <h1 id="pageTitle" class="fs-1 font-bankgothic fw-bold mb-1">Crear servicio</h1>
      <p class="text-secondary mb-0">Completá los datos del servicio y agregá uno o más planes.</p>
    </div>
  </section>

  <section class="mt-3 py-5 container">
    <form method="POST" action="{{ route('services.store') }}" enctype="multipart/form-data"
          class="bg-azul text-light p-4 rounded-3 shadow-sm">
      @csrf

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
        <textarea name="conditions" id="conditions" rows="3" class="form-control" placeholder="Ej: Soporte técnico, Renovación automática, Cancelación gratuita"></textarea>
        <small class="text-secondary">Separá cada condición con una coma.</small>
        @error('conditions')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
      </div>

      {{-- Planes dinámicos --}}
      <h4 class="font-bankgothic text-turquesa mt-5 mb-3">Planes del servicio</h4>
      <div id="plans-container">
        <div class="plan-item border rounded-3 p-3 mb-3">
          <div class="row g-2">
            <div class="col-lg-4">
              <label class="form-label">Nombre del plan</label>
              <input type="text" name="plans[0][name]" class="form-control" required>
            </div>
            <div class="col-lg-3">
              <label class="form-label">Precio (AR$)</label>
              <input type="number" name="plans[0][price]" class="form-control" step="0.01" required>
            </div>
            <div class="col-lg-3">
              <label class="form-label">Tipo</label>
              <select name="plans[0][type]" class="form-select">
                <option value="único">Único</option>
                <option value="mensual">Mensual</option>
                <option value="anual">Anual</option>
              </select>
            </div>
            <div class="col-lg-12 mt-2">
              <label class="form-label">Características (separadas por coma)</label>
              <input type="text" name="plans[0][features]" class="form-control" placeholder="Hosting, Dominio, Soporte técnico">
              <small class="text-secondary">Separá cada característica con una coma.</small>
            </div>
          </div>
        </div>
      </div>

      {{-- Botón agregar plan --}}
      <div class="d-flex justify-content-start mb-4">
        <button type="button" id="addPlan" class="btn btn-outline-turquesa">
          <i class="bi bi-plus-circle"></i> Agregar otro plan
        </button>
      </div>

      {{-- Botones finales --}}
      <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('services.index') }}" class="btn btn-outline-light">
          <i class="bi bi-arrow-left"></i> Volver
        </a>
        <button type="submit" class="btn btn-turquesa">
          <i class="bi bi-save"></i> Guardar servicio
        </button>
      </div>
    </form>
  </section>

  {{-- Script duplicar planes --}}
  @push('scripts')
    <script>
      let planIndex = 1;

      document.getElementById('addPlan').addEventListener('click', function () {
        const container = document.getElementById('plans-container');
        const newPlan = document.createElement('div');
        newPlan.classList.add('plan-item', 'border', 'rounded-3', 'p-3', 'mb-3');

        newPlan.innerHTML = `
      <div class="row g-2">
        <div class="col-lg-4">
          <label class="form-label">Nombre del plan</label>
          <input type="text" name="plans[${planIndex}][name]" class="form-control" required>
        </div>
        <div class="col-lg-3">
          <label class="form-label">Precio (AR$)</label>
          <input type="number" name="plans[${planIndex}][price]" class="form-control" step="0.01" required>
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
        <i class="bi bi-trash"></i> Quitar plan
      </button>
    `;

        container.appendChild(newPlan);
        planIndex++;
      });

      // Eliminar plan dinámico
      document.addEventListener('click', function (e) {
        if (e.target.closest('.removePlan')) {
          e.target.closest('.plan-item').remove();
        }
      });
    </script>
  @endpush
@endsection
