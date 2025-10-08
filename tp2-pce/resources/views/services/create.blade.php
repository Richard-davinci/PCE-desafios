@extends('layouts.admin')

@section('title', 'Crear servicio')

@section('content')
  <div class="container py-5">
    <h1 class="font-bankgothic text-turquesa mb-4">Crear nuevo servicio</h1>

    <form method="POST" action="{{ route('services.store') }}" enctype="multipart/form-data" class="bg-azul text-light p-4 rounded-3 shadow-sm">
      @csrf

      {{-- Nombre --}}
      <div class="mb-3">
        <label for="name" class="form-label">Nombre del servicio</label>
        <input type="text" name="name" id="name" class="form-control" required>
      </div>

      {{-- Categoría --}}
      <div class="mb-3">
        <label for="category" class="form-label">Categoría</label>
        <input type="text" name="category" id="category" class="form-control" required>
      </div>

      {{-- Estado --}}
      <div class="mb-3">
        <label for="status" class="form-label">Estado</label>
        <select name="status" id="status" class="form-select" required>
          <option value="Activo">Activo</option>
          <option value="Pausado">Pausado</option>
          <option value="Discontinuado">Discontinuado</option>
        </select>
      </div>

      {{-- Subtítulo --}}
      <div class="mb-3">
        <label for="subtitle" class="form-label">Subtítulo</label>
        <input type="text" name="subtitle" id="subtitle" class="form-control">
      </div>

      {{-- Descripción --}}
      <div class="mb-3">
        <label for="description" class="form-label">Descripción</label>
        <textarea name="description" id="description" rows="4" class="form-control"></textarea>
      </div>

      {{-- Condiciones (opcional) --}}
      <div class="mb-3">
        <label for="conditions" class="form-label">Condiciones</label>
        <textarea name="conditions" id="conditions" rows="3" class="form-control"></textarea>
      </div>

      {{-- Imágenes --}}
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="cover_image" class="form-label">Imagen principal (cover)</label>
          <input type="file" name="cover_image" id="cover_image" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
          <label for="thumb_image" class="form-label">Imagen miniatura (thumb)</label>
          <input type="file" name="thumb_image" id="thumb_image" class="form-control">
        </div>
      </div>

      {{-- Planes dinámicos --}}
      <h4 class="font-bankgothic text-turquesa mt-5 mb-3">Planes del servicio</h4>
      <div id="plans-container">
        <div class="plan-item border rounded-3 p-3 mb-3">
          <div class="row g-2">
            <div class="col-md-4">
              <label class="form-label">Nombre del plan</label>
              <input type="text" name="plans[0][name]" class="form-control" required>
            </div>
            <div class="col-md-3">
              <label class="form-label">Precio (AR$)</label>
              <input type="number" name="plans[0][price]" class="form-control" step="0.01" required>
            </div>
            <div class="col-md-3">
              <label class="form-label">Tipo</label>
              <select name="plans[0][type]" class="form-select">
                <option value="único">Único</option>
                <option value="mensual">Mensual</option>
                <option value="anual">Anual</option>
              </select>
            </div>
            <div class="col-md-12 mt-2">
              <label class="form-label">Características (separadas por coma)</label>
              <input type="text" name="plans[0][features]" class="form-control" placeholder="Hosting, Dominio, Soporte técnico">
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
  </div>

  {{-- Script para duplicar planes --}}
  @push('scripts')
    <script>
      let planIndex = 1;

      document.getElementById('addPlan').addEventListener('click', function() {
        const container = document.getElementById('plans-container');

        const newPlan = document.createElement('div');
        newPlan.classList.add('plan-item', 'border', 'rounded-3', 'p-3', 'mb-3');

        newPlan.innerHTML = `
      <div class="row g-2">
        <div class="col-md-4">
          <label class="form-label">Nombre del plan</label>
          <input type="text" name="plans[${planIndex}][name]" class="form-control" required>
        </div>
        <div class="col-md-3">
          <label class="form-label">Precio (AR$)</label>
          <input type="number" name="plans[${planIndex}][price]" class="form-control" step="0.01" required>
        </div>
        <div class="col-md-3">
          <label class="form-label">Tipo</label>
          <select name="plans[${planIndex}][type]" class="form-select">
            <option value="único">Único</option>
            <option value="mensual">Mensual</option>
            <option value="anual">Anual</option>
          </select>
        </div>
        <div class="col-md-12 mt-2">
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

      // Quitar plan
      document.addEventListener('click', function(e) {
        if (e.target.closest('.removePlan')) {
          e.target.closest('.plan-item').remove();
        }
      });
    </script>
  @endpush
@endsection
