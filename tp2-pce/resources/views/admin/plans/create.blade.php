@extends('layouts.app')

@section('title', 'Agregar planes')

@section('content')
  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container">
      <h1 id="pageTitle" class="fs-1 font-bankgothic fw-bold mb-1">   Crear planes para <span class="text-light">{{ $service->name }}</span></h1>
      <p class="text-secondary mb-0">Completá los datos del servicio y agregá uno o más planes.</p>
      <a href="{{ route('admin.services.index') }}" class="btn btn-turquesa font-bankgothic mt-2">
        <i class="bi bi-arrow-left"></i> Volver
      </a>
    </div>
  </section>
  <section class="container">
    <x-breadcrumb
      :items="[['label' => 'Servicios',   'route' => 'admin.services.index'],  ['label' => 'crear-plan']]"
      separator="›"/>
  </section>
  <div class="container py-4">
    {{-- Mensajes de validación / éxito --}}
    @if ($errors->any())
      <div class="alert alert-danger">
        <strong>Ups!</strong> Revisá los errores debajo:
        <ul class="mb-0 mt-2">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Formulario principal --}}
    <form action="{{ route('admin.services.plans.store', $service) }}" method="POST">
      @csrf

      {{-- Tipo de plan: único o mensual --}}
      <div class="card bg-azul border-light mb-4 shadow-sm">
        <div class="card-body">
          <p class="mb-2 fw-bold">Elegí el tipo de plan:</p>
          <div class="d-flex gap-4 align-items-center">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="mode" id="modeUnico" value="unico" checked>
              <label class="form-check-label" for="modeUnico">Único</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="mode" id="modeMensual" value="mensual">
              <label class="form-check-label" for="modeMensual">Mensual (Básico, Pro, Empresarial)</label>
            </div>
          </div>
        </div>
      </div>

      {{-- SECCIÓN: Plan ÚNICO --}}
      <section id="blockUnico">
        <div class="card bg-azul border-light shadow-sm mb-4">
          <div class="card-header">
            <h5 class="font-bankgothic text-turquesa mb-0">Plan Único</h5>
          </div>
          <div class="card-body">
            <div class="row g-3">
              {{-- Nombre fijo --}}
              <div class="col-md-6">
                <label class="form-label">Nombre</label>
                <input type="text" name="plans[0][name]" value="Único" class="form-control" readonly>
              </div>

              {{-- Precio único --}}
              <div class="col-md-6">
                <label class="form-label">Precio (USD)</label>
                <input type="number" name="plans[0][price]" class="form-control" min="0" step="0.01" placeholder="Ej: 1500">
              </div>

              {{-- Características --}}
              <div class="col-12">
                <label class="form-label">Características</label>
                <input type="text" name="plans[0][features]" class="form-control"
                       placeholder="Hosting, Dominio, Soporte (separadas por coma)">
              </div>
            </div>
            <input type="hidden" name="plans[0][type]" value="único">
          </div>
        </div>
      </section>

      {{-- SECCIÓN: Planes MENSUALES --}}
      <section id="blockMensual" style="display:none;">
        {{-- Plan Básico --}}
        <div class="card bg-azul border-light shadow-sm mb-4">
          <div class="card-header"><h5 class="font-bankgothic text-turquesa mb-0">Plan Básico</h5></div>
          <div class="card-body">
            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label">Nombre</label>
                <input type="text" name="plans[0][name]" value="Básico" class="form-control" readonly>
              </div>
              <div class="col-md-4">
                <label class="form-label">Precio mensual (USD)</label>
                <input type="number" name="plans[0][price]" class="form-control" min="0" step="0.01">
              </div>
              <div class="col-md-4">
                <label class="form-label">Descuento anual (%)</label>
                <input type="number" name="plans[0][discount]" class="form-control" min="0" max="100" step="1" placeholder="Ej: 10">
              </div>
              <div class="col-12">
                <label class="form-label">Características</label>
                <input type="text" name="plans[0][features]" class="form-control"
                       placeholder="Hosting, SSL, Soporte técnico">
              </div>
            </div>
            <input type="hidden" name="plans[0][type]" value="mensual">
          </div>
        </div>

        {{-- Plan Pro --}}
        <div class="card bg-azul border-light shadow-sm mb-4">
          <div class="card-header"><h5 class="font-bankgothic text-turquesa mb-0">Plan Profesional</h5></div>
          <div class="card-body">
            <div class="row g-3">
              <div class="col-md-4">
                <input type="text" name="plans[1][name]" value="Pro" class="form-control" readonly>
              </div>
              <div class="col-md-4">
                <input type="number" name="plans[1][price]" class="form-control" placeholder="Precio mensual (USD)">
              </div>
              <div class="col-md-4">
                <input type="number" name="plans[1][discount]" class="form-control" placeholder="Descuento anual (%)">
              </div>
              <div class="col-12">
                <input type="text" name="plans[1][features]" class="form-control"
                       placeholder="Extras respecto al Básico (coma separadas)">
              </div>
            </div>
            <input type="hidden" name="plans[1][type]" value="mensual">
          </div>
        </div>

        {{-- Plan Empresarial --}}
        <div class="card bg-azul border-light shadow-sm">
          <div class="card-header"><h5 class="font-bankgothic text-turquesa mb-0">Plan Empresarial</h5></div>
          <div class="card-body">
            <div class="row g-3">
              <div class="col-md-4">
                <input type="text" name="plans[2][name]" value="Empresarial" class="form-control" readonly>
              </div>
              <div class="col-md-4">
                <input type="number" name="plans[2][price]" class="form-control" placeholder="Precio mensual (USD)">
              </div>
              <div class="col-md-4">
                <input type="number" name="plans[2][discount]" class="form-control" placeholder="Descuento anual (%)">
              </div>
              <div class="col-12">
                <input type="text" name="plans[2][features]" class="form-control"
                       placeholder="Extras respecto a Profesional (coma separadas)">
              </div>
            </div>
            <input type="hidden" name="plans[2][type]" value="mensual">
          </div>
        </div>
      </section>

      {{-- Botones --}}
      <div class="d-flex justify-content-end mt-4 gap-3">
        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-light">Cancelar</a>
        <button type="submit" class="btn btn-turquesa font-bankgothic px-4">
          <i class="bi bi-check-circle"></i> Guardar planes
        </button>
      </div>

    </form>
  </div>
@endsection


@push('scripts')
  <script>
    // Mostrar/ocultar secciones según el tipo seleccionado
    document.addEventListener('DOMContentLoaded', function () {
      const unicoRadio = document.getElementById('modeUnico');
      const mensualRadio = document.getElementById('modeMensual');
      const blockUnico = document.getElementById('blockUnico');
      const blockMensual = document.getElementById('blockMensual');

      function toggleSections() {
        blockUnico.style.display = unicoRadio.checked ? 'block' : 'none';
        blockMensual.style.display = mensualRadio.checked ? 'block' : 'none';
      }

      unicoRadio.addEventListener('change', toggleSections);
      mensualRadio.addEventListener('change', toggleSections);
      toggleSections();
    });
  </script>
@endpush
