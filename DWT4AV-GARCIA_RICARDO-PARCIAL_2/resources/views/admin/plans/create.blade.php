@extends('layouts.app')

@section('title', 'Crear planes - ' . $service->name)

@section('content')

  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container mb-4">
      <h1 id="pageTitle" class="fs-1 font-bankgothic fw-bold mb-1">
        Crear planes para {{ $service->name }}
      </h1>
      <p class="text-secondary mb-0">
        Definí si este servicio tendrá un plan único o planes mensuales (Básico / Profesional
        / Empresarial).
      </p>
      <a href="{{ route('admin.services.index') }}" class="btn btn-turquesa mt-3">
        <i class="bi bi-arrow-left"></i> Volver
      </a>
    </div>
  </section>

  <div class="container">
    <x-breadcrumb
      :items="[['label' => 'Servicios', 'route' => 'admin.services.index'], ['label' => 'Crear-plan']]"
      separator="›"/>
  </div>

  {{-- =========================================================
       Se establece la variable $currentMode(modo actual) para mantener el modo actual o el anterior
       ========================================================= --}}
  @php
    $currentMode = old('mode', $mode ?? 'unico');
  @endphp
  <div class="container py-4">
    <form id="plansForm" action="{{ route('admin.services.plans.store', $service) }}" method="POST">
      @csrf

      {{-- =========================================================
          MODO DE PLANES
          Sección con radio buttons para seleccionar entre modo "Unico" o "Mensual".
          ========================================================= --}}
      {{--      <input type="hidden" id="initialMode" value="{{ $mode }}">--}}


      <div class="card shadow-sm rounded-2 bg-azul mb-3">
        <div class="card-body">
          <p class="mb-2">Elegí el tipo de plan para este servicio:</p>
          {{-- Grupo de radio buttons para seleccionar modo --}}
          <div class="d-flex gap-4 align-items-center">
            {{-- Opción plan único --}}
            <label class="form-check mb-0">
              <input class="form-check-input"
                     type="radio"
                     name="mode"
                     id="modeUnico"
                     value="unico"
                {{ $currentMode === 'unico' ? 'checked' : '' }}>
              <span class="form-check-label">Único</span>
            </label>

            {{-- Opción planes mensuales --}}
            <label class="form-check mb-0">
              <input class="form-check-input"
                     type="radio"
                     name="mode"
                     id="modeMensual"
                     value="mensual"
                {{ $currentMode === 'mensual' ? 'checked' : '' }}>
              <span class="form-check-label">Mensual (Básico / Profesional
 / Empresarial)</span>
            </label>
          </div>
          @error('mode')
          <x-alert type="danger" :message="$message" small/>
          @enderror
        </div>
      </div>

      {{-- =========================================================
           BLOCK PLANES UNICO
           ========================================================= --}}
      <section id="blockUnico" style="{{ $currentMode === 'unico' ? '' : 'display:none;' }}">
        <div id="planesAccordion">
          <div class="card bg-azul my-4 border-light">

            {{-- Collapsible para el plan único --}}
            <div class="card-header">
              <button
                class="btn btn-link text-light d-flex justify-content-between w-100 align-items-center p-0 text-decoration-none"
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
            {{-- Campos de precio y características --}}
            <div id="collapseUnico" class="collapse show" data-bs-parent="#planesAccordion">
              <div class="card-body border-top border-light bg-azul-light text-light rounded-bottom-3">
                <div class="row g-3">

                  {{-- Precio único --}}
                  <div class="col-md-3 col-lg-4">
                    <label class="form-label">Precio único (U$D)</label>
                    <input type="number"
                           name="plans[unico][price]"
                           class="form-control"
                           min="0"
                           step="0.01"
                           placeholder="Ej: 1450"
                           value="{{ old('plans.unico.price') ?? '0' }}"
                    >
                    @error('plans.unico.price')
                    <x-alert type="danger" :message="$message" small/>
                    @enderror
                  </div>

                  {{-- Características(features) --}}
                  <div class="col-md-9 col-lg-8">
                    <label class="form-label">Características</label>
                    <input type="text"
                           name="plans[unico][features]"
                           class="form-control"
                           placeholder="Ej: Hosting, Dominio .com, SSL, Instalación"
                           value="{{ old('plans.unico.features') ?? '' }}
">
                    <small class="text-secondary">Separá las características por coma.</small>
                    @error('plans.unico.features')
                    <x-alert type="danger" :message="$message" small/>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {{-- =========================================================
          BLOCK PLANES MENSUALES
          Se muestra solo si $currentMode es 'mensual'.
          Incluye planes Básico, Profesional
 y Empresarial en acordeón.
          ========================================================= --}}
      <section id="blockMensual" style="{{ $currentMode === 'mensual' ? '' : 'display:none;' }}">
        <div id="planesAccordionMensual">

          {{------------ PLAN BÁSICO -----------------------}}
          <div class="card bg-azul my-4 border-light">

            {{-- Collapsible para plan Básico --}}
            <div class="card-header">
              <button
                class="btn btn-link text-light d-flex justify-content-between w-100 align-items-center p-0 text-decoration-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseBasico"
                aria-expanded="true"
                aria-controls="collapseBasico">
                <span class="font-bankgothic fs-5">Básico</span>
                <span class="plan-toggle-icon" data-target="collapseBasico">
                    <i class="bi bi-chevron-down"></i>
                  </span>
              </button>
            </div>

            {{-- Campos del plan Básico --}}
            <div id="collapseBasico" class="collapse show" data-bs-parent="#planesAccordionMensual">
              <div class="card-body border-top border-light bg-azul-light text-light rounded-bottom-3">
                <div class="row g-3">

                  {{-- Precio mensual --}}
                  <div class="col-md-4">
                    <label class="form-label">Precio mensual (U$D)</label>
                    <input type="number"
                           id="basico-price"
                           name="plans[basico][price]"
                           class="form-control"
                           min="0"
                           step="0.01"
                           value="{{ old('plans.basico.price') ?? '0' }}"
                    >
                    @error('plans.basico.price')
                    <x-alert type="danger" :message="$message" small/>
                    @enderror
                  </div>

                  {{-- Descuento anual --}}
                  <div class="col-md-4">
                    <label class="form-label">Descuento anual (%)</label>
                    <input type="number"
                           id="basico-discount"
                           name="plans[basico][discount]"
                           class="form-control"
                           min="0"
                           max="100"
                           step="1"
                           value="{{ old('plans.basico.discount') ?? '0' }}"
                    >
                  </div>
                  {{-- Precio anual calculado automáticamente --}}
                  <div class="col-md-4">
                    <label class="form-label">Precio anual (U$D)</label>
                    <input type="number"
                           id="basico-annual-price"
                           class="form-control"
                           readonly>
                    <small class="text-secondary">Se calcula automáticamente según mensual + descuento.</small>
                  </div>

                  {{-- Características básicas --}}
                  <div class="col-12">
                    <label class="form-label">Características Básico</label>
                    <input type="text"
                           name="plans[basico][features]"
                           class="form-control"
                           placeholder="Ej: Hosting, SSL, Soporte básico"
                           value="{{ old('plans.basico.features') ?? '' }}">
                    <small class="text-secondary">Separá las características por coma.</small>
                    @error('plans.basico.features')
                    <x-alert type="danger" :message="$message" small/>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{------------ PLAN PRO -----------------------}}
          <div class="card bg-azul my-4 border-light">
            <div class="card-header">
              <button
                class="btn btn-link text-light d-flex justify-content-between w-100 align-items-center p-0 text-decoration-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapsePro"
                aria-expanded="false"
                aria-controls="collapsePro">
                <span class="font-bankgothic fs-5">Profesional
</span>
                <span class="plan-toggle-icon" data-target="collapsePro">
                    <i class="bi bi-chevron-down"></i>
                  </span>
              </button>
            </div>

            <div id="collapsePro" class="collapse" data-bs-parent="#planesAccordionMensual">
              <div class="card-body border-top border-light bg-azul-light text-light rounded-bottom-3">
                <div class="row g-3">

                  {{-- Precio mensual --}}
                  <div class="col-md-4">
                    <label class="form-label">Precio mensual (U$D)</label>
                    <input type="number"
                           id="pro-price"
                           name="plans[pro][price]"
                           class="form-control"
                           min="0"
                           step="0.01"
                           value="{{ old('plans.pro.price') ?? '0' }}"
                    >
                    @error('plans.pro.price')
                    <x-alert type="danger" :message="$message" small/>
                    @enderror
                  </div>

                  {{-- Descuento anual --}}
                  <div class="col-md-4">
                    <label class="form-label">Descuento anual (%)</label>
                    <input type="number"
                           id="pro-discount"
                           name="plans[pro][discount]"
                           class="form-control"
                           min="0"
                           max="100"
                           step="1"
                           value="{{ old('plans.pro.discount') ?? '0' }}"
                    >
                  </div>

                  {{-- Precio anual calculado automáticamente --}}
                  <div class="col-md-4">
                    <label class="form-label">Precio anual (U$D)</label>
                    <input type="number"
                           id="pro-annual-price"
                           class="form-control"
                           readonly>
                    <small class="text-secondary">Se calcula automáticamente según mensual + descuento.</small>
                  </div>

                  {{-- Características Profesional
 --}}
                  <div class="col-12">
                    <label class="form-label">Características Profesional
                    </label>
                    <input type="text"
                           name="plans[pro][features]"
                           class="form-control"
                           placeholder="Ej: Todo lo de Básico + extras"
                           value="{{ old('plans.pro.features') ?? '' }}
">
                    <small class="text-secondary">Separá las características por coma.</small>
                    @error('plans.pro.features')
                    <x-alert type="danger" :message="$message" small/>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{------------ PLAN EMPRESARIAL -----------------------}}
          <div class="card bg-azul my-4 border-light">
            <div class="card-header">
              <button
                class="btn btn-link text-light d-flex justify-content-between w-100 align-items-center p-0 text-decoration-none"
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

            {{-- Precio mensual --}}
            <div id="collapseEmpresarial" class="collapse" data-bs-parent="#planesAccordionMensual">
              <div class="card-body border-top border-light bg-azul-light text-light rounded-bottom-3">
                <div class="row g-3">
                  <div class="col-md-4">
                    <label class="form-label">Precio mensual (U$D)</label>
                    <input type="number"
                           id="empresarial-price"
                           name="plans[empresarial][price]"
                           class="form-control"
                           min="0"
                           step="0.01"
                           value="{{ old('plans.empresarial.price') ?? '0' }}"
                    >
                    @error('plans.empresarial.price')
                    <x-alert type="danger" :message="$message" small/>
                    @enderror
                  </div>

                  {{-- Descuento anual --}}
                  <div class="col-md-4">
                    <label class="form-label">Descuento anual (%)</label>
                    <input type="number"
                           id="empresarial-discount"
                           name="plans[empresarial][discount]"
                           class="form-control"
                           min="0"
                           max="100"
                           step="1"
                           value="{{ old('plans.empresarial.discount') ?? '0' }}"
                    >
                  </div>

                  {{-- Precio anual automático --}}
                  <div class="col-md-4">
                    <label class="form-label">Precio anual (U$D)</label>
                    <input type="number"
                           id="empresarial-annual-price"
                           class="form-control"
                           readonly>
                    <small class="text-secondary">Se calcula automáticamente según mensual + descuento.</small>
                  </div>

                  {{-- Características Empresarial --}}
                  <div class="col-12">
                    <label class="form-label">Características Empresarial</label>
                    <input type="text"
                           name="plans[empresarial][features]"
                           class="form-control"
                           placeholder="Ej: Soporte prioritario, SLA, integraciones avanzadas"
                           value="{{ old('plans.empresarial.features') ?? '' }}"
                    >
                    <small class="text-secondary">Separá las características por coma.</small>
                    @error('plans.empresarial.features')
                    <x-alert type="danger" :message="$message" small/>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </section>

      <div class="card shadow-sm rounded-2 bg-azul mb-3">
        <div class="card-body d-flex justify-content-end gap-3">
          <a href="{{ route('admin.services.index') }}" class="btn btn-outline-turquesa">
            <i class="fa-solid fa-close"></i> Cancelar
          </a>
          <button type="submit" id="submitPlansBtn" class="btn  btn-turquesa font-bankgothic px-4">
            <i class="fa-solid fa-floppy-disk"></i> Guardar planes
          </button>
        </div>
      </div>
    </form>
  </div>
  </div>
@endsection

{{-- =========================================================
     SCRIPTS
     Funcionalidad JS para collapses, cambiar iconos,
     mostrar/ocultar bloques, cálculos y confirmaciones.
     ========================================================= --}}
@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // =========================================================
      // ícono en los collapsible
      // =========================================================

      document.querySelectorAll('.plan-toggle-icon').forEach((toggle) => {
        const targetId = toggle.dataset.target;                  // id del collapse asociado
        const collapseEl = document.querySelector('#' + targetId);
        if (!collapseEl) return;

        collapseEl.addEventListener('show.bs.collapse', () => {
          const icon = toggle.querySelector('i');
          if (!icon) return;
          icon.classList.remove('bi-chevron-down');
          icon.classList.add('bi-chevron-up');
        });

        collapseEl.addEventListener('hide.bs.collapse', () => {
          const icon = toggle.querySelector('i');
          if (!icon) return;
          icon.classList.remove('bi-chevron-up');
          icon.classList.add('bi-chevron-down');
        });
      });

      // =========================================================
      // 2) Mostrar / ocultar bloques según modo (Único / Mensual)
      // =========================================================
      const blockUnico = document.querySelector('#blockUnico');
      const blockMensual = document.querySelector('#blockMensual');
      const unicoRadio = document.querySelector('input[name="mode"][value="unico"]');
      const mensualRadio = document.querySelector('input[name="mode"][value="mensual"]');

      /**
       * Actualiza la visibilidad de los bloques según el radio seleccionado.
       */
      function updateModeUI() {
        if (!blockUnico || !blockMensual || !unicoRadio || !mensualRadio) return;

        if (unicoRadio.checked) {
          blockUnico.style.display = '';
          blockMensual.style.display = 'none';
        } else if (mensualRadio.checked) {
          blockUnico.style.display = 'none';
          blockMensual.style.display = '';
        }
      }

      // Escuchamos cambios de modo
      if (unicoRadio && mensualRadio) {
        unicoRadio.addEventListener('change', updateModeUI);
        mensualRadio.addEventListener('change', updateModeUI);
      }

      // Estado inicial
      updateModeUI();

      // =========================================================
      // 3) Cálculo automático de precios anuales
      // =========================================================
      /**
       * Configura el cálculo de precio anual para un trío de inputs:
       * - monthlySelector: input de precio mensual
       * - discountSelector: input de descuento (%)
       * - annualSelector: input donde se muestra el precio anual calculado
       *
       * Fórmula:
       *   anual = mensual * 12 * (1 - descuento/100)
       */
      function setupAnnualCalc(monthlySelector, discountSelector, annualSelector) {
        const monthly = document.querySelector(monthlySelector);
        const discount = document.querySelector(discountSelector);
        const annual = document.querySelector(annualSelector);

        if (!monthly || !discount || !annual) return;

        function recalc() {
          const price = parseFloat(monthly.value) || 0;
          const disc = parseFloat(discount.value) || 0;

          if (price > 0) {
            const annualPrice = price * 12 * (1 - (disc / 100));
            annual.value = annualPrice > 0 ? annualPrice.toFixed(2) : '';
          } else {
            annual.value = '';
          }
        }

        // Recalcular cuando cambia el precio mensual o el descuento
        monthly.addEventListener('input', recalc);
        discount.addEventListener('input', recalc);

        // Calcular una vez al inicio
        recalc();
      }

      // Aplicamos a cada plan mensual
      setupAnnualCalc('#basico-price', '#basico-discount', '#basico-annual-price');
      setupAnnualCalc('#pro-price', '#pro-discount', '#pro-annual-price');
      setupAnnualCalc('#empresarial-price', '#empresarial-discount', '#empresarial-annual-price');
    });
  </script>

@endpush
