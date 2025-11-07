@extends('layouts.app')

@section('title', 'Gestionar planes - ' . $service->name)

@section('content')
  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container mb-4">
      <h1 id="pageTitle" class="fs-1 font-bankgothic fw-bold mb-1"> Gestionar planes para {{ $service->name }}</h1>
      <p class="text-secondary mb-0">Definí si este servicio tiene un plan único o planes mensuales.</p>
      <a href="{{ route('admin.services.index') }}" class="btn btn-turquesa">
        <i class="bi bi-arrow-left"></i> Volver
      </a>
    </div>
  </section>
  <section class="container">
    <x-breadcrumb
      :items="[['label' => 'Servicios',   'route' => 'admin.services.index'],  ['label' => 'Gestionar-plan']]"
      separator="›"/>
  </section>
  <div class="container py-4">
    {{-- Errores --}}
    @if ($errors->any())
      <div class="alert alert-danger">
        <strong>Revisá los campos:</strong>
        <ul class="mb-0 mt-2">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif


    <form id="plansForm" action="{{ route('admin.services.plans.update', $service) }}" method="POST">
      @csrf
      @method('PUT')
      <input type="hidden" id="initialMode" value="{{ $mode }}">

      {{-- Selector de modo --}}
      <div class="card shadow-sm rounded-2 bg-azul mb-3">
        <div class="card-body">
          <p class="mb-2">Elegí el tipo de plan para este servicio:</p>
          <div class="d-flex gap-4 align-items-center">
            <label class="form-check mb-0">
              <input class="form-check-input" type="radio" name="mode" id="modeUnico"
                     value="unico" {{ $mode === 'unico' ? 'checked' : '' }}>
              <span class="form-check-label">Único</span>
            </label>
            <label class="form-check mb-0">
              <input class="form-check-input" type="radio" name="mode" id="modeMensual"
                     value="mensual" {{ $mode === 'mensual' ? 'checked' : '' }}>
              <span class="form-check-label">Mensual (Básico, Profesional, Empresarial)</span>
            </label>
          </div>
        </div>
      </div>

      {{-- PLAN ÚNICO --}}
      @php
        $featuresUnico = $unique ? ($unique->features ?? []) : [];
      @endphp

      <section id="blockUnico" style="{{ $mode === 'unico' ? '' : 'display:none;' }}">
        <div id="planesAccordion">
          <div class="card bg-azul mb-4 border-light">
            <div class="card-header">
              <button
                class="btn btn-link text-turquesa d-flex justify-content-between w-100 align-items-center p-0 text-decoration-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseUnico"
                aria-expanded="true"
                aria-controls="collapseUnico">
                <span class="font-bankgothic fs-5">Plan Único</span>
                <span class="plan-toggle-icon" data-target="collapseUnico">
                    <i class="bi bi-chevron-down"></i>
                  </span>
              </button>
            </div>
            <div id="collapseUnico" class="collapse show" data-bs-parent="#planesAccordion">
              <div class="card-body border-top border-light">
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label">Precio único (U$D)</label>
                    <input type="number"
                           name="plans[unico][price]"
                           class="form-control"
                           min="0" step="0.01"
                           placeholder="Ej: 1450"
                           value="{{ old('plans.unico.price', $unique->price ?? '') }}">
                  </div>
                  <div class="col-12">
                    <label class="form-label">Características</label>
                    <input type="text"
                           name="plans[unico][features]"
                           class="form-control"
                           placeholder="Ej: Hosting, Dominio .com, SSL, Instalación"
                           value="{{ old('plans.unico.features', implode(', ', $featuresUnico)) }}">
                    <small class="text-secondary">Separá las características por coma.</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {{-- PLANES MENSUALES --}}
      {{-- PLANES MENSUALES --}}
      <section id="blockMensual" style="{{ $mode === 'mensual' ? '' : 'display:none;' }}">
        <div id="planesAccordionMensual">

          @php
            // Helpers para features y valores seguros
            $fBasico       = $pBasico ? ($pBasico->features ?? []) : [];
            $fPro          = $pPro ? ($pPro->features ?? []) : [];
            $fEmpresarial  = $pEmpresarial ? ($pEmpresarial->features ?? []) : [];

            $precioBasico      = optional($pBasico)->price;
            $descuentoBasico   = optional($pBasico)->discount;
            $precioAnualBasico = $precioBasico
                                    ? round($precioBasico * 12 * (1 - (($descuentoBasico ?? 0) / 100)), 2)
                                    : '';

            $precioPro         = optional($pPro)->price;
            $descuentoPro      = optional($pPro)->discount;
            $precioAnualPro    = $precioPro
                                    ? round($precioPro * 12 * (1 - (($descuentoPro ?? 0) / 100)), 2)
                                    : '';

            $precioEmp         = optional($pEmpresarial)->price;
            $descuentoEmp      = optional($pEmpresarial)->discount;
            $precioAnualEmp    = $precioEmp
                                    ? round($precioEmp * 12 * (1 - (($descuentoEmp ?? 0) / 100)), 2)
                                    : '';
          @endphp

          {{-- BASICO --}}
          <div class="card bg-azul mb-4 border-light">
            <div class="card-header">
              <button
                class="btn btn-link text-turquesa d-flex justify-content-between w-100 align-items-center p-0 text-decoration-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseBasico"
                aria-expanded="false"
                aria-controls="collapseBasico">
                <span class="font-bankgothic fs-5">Básico</span>
                <span class="plan-toggle-icon" data-target="collapseBasico">
            <i class="bi bi-chevron-down"></i>
          </span>
              </button>
            </div>
            <div id="collapseBasico" class="collapse" data-bs-parent="#planesAccordionMensual">
              <div class="card-body border-top border-light">
                <div class="row g-3">
                  <div class="col-md-4">
                    <label class="form-label">Precio mensual (U$D)</label>
                    <input type="number"
                           name="plans[basico][price]"
                           class="form-control"
                           min="0" step="0.01"
                           value="{{ old('plans.basico.price', $precioBasico) }}">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">Descuento anual (%)</label>
                    <input type="number"
                           name="plans[basico][discount]"
                           class="form-control"
                           min="0" max="100" step="1"
                           value="{{ old('plans.basico.discount', $descuentoBasico) }}">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">Precio anual (U$D)</label>
                    <input type="number"
                           id="basico-annual-price"
                           class="form-control"
                           value="{{ $precioAnualBasico }}"
                           readonly>
                    <small class="text-secondary">Se calcula automáticamente según mensual + descuento.</small>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Características Básico</label>
                    <input type="text"
                           name="plans[basico][features]"
                           class="form-control"
                           placeholder="Ej: Hosting, SSL, Panel admin"
                           value="{{ old('plans.basico.features', implode(', ', $fBasico)) }}">
                    <small class="text-secondary">Base para Profesional y Empresarial.</small>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{-- PROFESIONAL --}}
          <div class="card bg-azul mb-4 border-light">
            <div class="card-header">
              <button
                class="btn btn-link text-turquesa d-flex justify-content-between w-100 align-items-center p-0 text-decoration-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapsePro"
                aria-expanded="false"
                aria-controls="collapsePro">
                <span class="font-bankgothic fs-5">Profesional</span>
                <span class="plan-toggle-icon" data-target="collapsePro">
            <i class="bi bi-chevron-down"></i>
          </span>
              </button>
            </div>
            <div id="collapsePro" class="collapse" data-bs-parent="#planesAccordionMensual">
              <div class="card-body border-top border-light">
                <div class="row g-3">
                  <div class="col-md-4">
                    <label class="form-label">Precio mensual (U$D)</label>
                    <input type="number"
                           name="plans[pro][price]"
                           class="form-control"
                           min="0" step="0.01"
                           value="{{ old('plans.pro.price', $precioPro) }}">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">Descuento anual (%)</label>
                    <input type="number"
                           name="plans[pro][discount]"
                           class="form-control"
                           min="0" max="100" step="1"
                           value="{{ old('plans.pro.discount', $descuentoPro) }}">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">Precio anual (U$D)</label>
                    <input type="number"
                           id="pro-annual-price"
                           class="form-control"
                           value="{{ $precioAnualPro }}"
                           readonly>
                    <small class="text-secondary">Se calcula automáticamente según mensual + descuento.</small>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Características Profesional</label>
                    <input type="text"
                           name="plans[pro][features]"
                           class="form-control"
                           placeholder="Ej: Soporte prioritario, Backups automáticos"
                           value="{{ old('plans.pro.features', implode(', ', $fPro)) }}">
                    <small class="text-secondary">Extras sobre el Básico.</small>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{-- EMPRESARIAL --}}
          <div class="card bg-azul mb-4 border-light">
            <div class="card-header">
              <button
                class="btn btn-link text-turquesa d-flex justify-content-between w-100 align-items-center p-0 text-decoration-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseEmpresarial"
                aria-expanded="false"
                aria-controls="collapseEmpresarial">
                <span class="font-bankgothic fs-5">Empresarial</span>
                <span class="plan-toggle-icon" data-target="collapseEmpresarial">
            <i class="bi bi-chevron-down"></i>
          </span>
              </button>
            </div>
            <div id="collapseEmpresarial" class="collapse" data-bs-parent="#planesAccordionMensual">
              <div class="card-body border-top border-light">
                <div class="row g-3">
                  <div class="col-md-4">
                    <label class="form-label">Precio mensual (U$D)</label>
                    <input type="number"
                           name="plans[empresarial][price]"
                           class="form-control"
                           min="0" step="0.01"
                           value="{{ old('plans.empresarial.price', $precioEmp) }}">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">Descuento anual (%)</label>
                    <input type="number"
                           name="plans[empresarial][discount]"
                           class="form-control"
                           min="0" max="100" step="1"
                           value="{{ old('plans.empresarial.discount', $descuentoEmp) }}">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">Precio anual (U$D)</label>
                    <input type="number"
                           id="empresarial-annual-price"
                           class="form-control"
                           value="{{ $precioAnualEmp }}"
                           readonly>
                    <small class="text-secondary">Se calcula automáticamente según mensual + descuento.</small>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Características Empresarial</label>
                    <input type="text"
                           name="plans[empresarial][features]"
                           class="form-control"
                           placeholder="Ej: Gestor dedicado, SLA 24/7"
                           value="{{ old('plans.empresarial.features', implode(', ', $fEmpresarial)) }}">
                    <small class="text-secondary">Extras sobre Profesional/Básico.</small>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </section>


      {{-- BOTONES --}}
      <div class="card shadow-sm rounded-2 bg-azul mb-3">
        <div class="card-body d-flex justify-content-end gap-3">
          <a href="{{ route('admin.services.index') }}" class="btn btn-outline-light">
            Cancelar
          </a>
          <button type="submit" class="btn btn-turquesa font-bankgothic px-4">
            <i class="bi bi-save"></i> Guardar planes
          </button>

        </div>
      </div>
      <div class="d-flex justify-content-between align-items-center mt-3">

      </div>

    </form>
  </div>

@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // ---------- toggle flechas ----------
      document.querySelectorAll('.plan-toggle-icon').forEach(toggle => {
        const targetId = toggle.dataset.target;
        const collapseEl = document.querySelector('#' + targetId);
        if (!collapseEl) return;

        collapseEl.addEventListener('show.bs.collapse', () => {
          const icon = toggle.querySelector('i');
          icon.classList.remove('bi-chevron-down');
          icon.classList.add('bi-chevron-up');
        });

        collapseEl.addEventListener('hide.bs.collapse', () => {
          const icon = toggle.querySelector('i');
          icon.classList.remove('bi-chevron-up');
          icon.classList.add('bi-chevron-down');
        });
      });

      // ---------- toggle bloques único / mensual ----------
      const unicoRadio = document.querySelector('#modeUnico');
      const mensualRadio = document.querySelector('#modeMensual');
      const blockUnico = document.querySelector('#blockUnico');
      const blockMensual = document.querySelector('#blockMensual');

      function toggleSections() {
        if (unicoRadio && unicoRadio.checked) {
          blockUnico.style.display = 'block';
          blockMensual.style.display = 'none';
        } else {
          blockUnico.style.display = 'none';
          blockMensual.style.display = 'block';
        }
      }

      if (unicoRadio && mensualRadio) {
        unicoRadio.addEventListener('change', toggleSections);
        mensualRadio.addEventListener('change', toggleSections);
        toggleSections();
      }

      // ---------- confirmación al cambiar modo ----------
      const form = document.querySelector('#plansForm');
      const initialModeInput = document.querySelector('#initialMode');

      if (form && initialModeInput) {
        form.addEventListener('submit', (e) => {
          const initialMode = initialModeInput.value; // 'unico' o 'mensual'
          const currentMode = unicoRadio && unicoRadio.checked ? 'unico' : 'mensual';

          // Si el modo cambió, avisamos que se borran los planes actuales
          if (initialMode !== '' && initialMode !== currentMode) {
            const message =
              currentMode === 'unico'
                ? 'Vas a pasar de planes Mensuales/Anuales a un Plan Único.\nSe eliminarán todos los planes mensuales/anuales actuales para este servicio.\n\n¿Confirmás guardar los cambios?'
                : 'Vas a pasar de Plan Único a planes Mensuales/Anuales.\nSe eliminará el plan único actual para este servicio.\n\n¿Confirmás guardar los cambios?';

            if (!confirm(message)) {
              e.preventDefault();
            }
          }
        });
      }

      function setupAnnualPreview(key) {
        const priceInput = document.querySelector(`[name="plans[${key}][price]"]`);
        const discountInput = document.querySelector(`[name="plans[${key}][discount]"]`);
        const annualInput = document.getElementById(`${key}-annual-price`);

        if (!priceInput || !annualInput) return;

        const recalc = () => {
          const price = parseFloat(priceInput.value);
          const discount = discountInput ? parseFloat(discountInput.value) : 0;

          if (isNaN(price) || price <= 0) {
            annualInput.value = '';
            return;
          }

          let annual = price * 12;

          if (!isNaN(discount) && discount > 0 && discount <= 100) {
            annual = annual * (1 - (discount / 100));
          }

          annualInput.value = annual.toFixed(2);
        };

        priceInput.addEventListener('input', recalc);
        if (discountInput) {
          discountInput.addEventListener('input', recalc);
        }

        recalc();
      }

      setupAnnualPreview('basico');
      setupAnnualPreview('pro');
      setupAnnualPreview('empresarial');
    });
  </script>
@endpush

