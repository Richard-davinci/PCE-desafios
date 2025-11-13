@extends('layouts.app')
@section('title', 'Editar planes - ' . $service->name)
@section('content')

  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container mb-4">
      <h1 id="pageTitle" class="fs-1 font-bankgothic fw-bold mb-1">
        Editar planes de {{ $service->name }}
      </h1>
      <p class="text-blanco mb-0">
        Modificá el plan único o los planes mensuales asociados a este servicio.
      </p>
      <a href="{{ route('admin.services.index') }}" class="btn btn-turquesa mt-3">
        <i class="fa-solid fa-arrow-left"></i> Volver
      </a>
    </div>
  </section>

  <div class="container">
    <x-breadcrumb
      :items="[['label' => 'Servicios', 'route' => 'admin.services.index'], ['label' => 'Editar-planes']]"
      separator="›"/>
  </div>

  {{-- =========================================================
       $currentMode(modo actual) para mantener el modo actual o el anterior
       ========================================================= --}}
  @php
    $currentMode = old('mode', $mode ?? 'unico');
  @endphp
  <div class="container py-4">
    <form id="plansForm" action="{{ route('admin.services.plans.update', $service) }}" method="POST">
      @csrf
      @method('PUT')

      {{-- =========================================================
                        radio burtton con modo "Unico" o "Mensual".
          ========================================================= --}}
      <div class="card shadow-sm rounded-2 bg-azul mb-3">
        <div class="card-body">
          <p class="mb-2">Tipo de planes configurados para este servicio:</p>
          <div class="d-flex gap-4 align-items-center">

            {{-- Opción plan único --}}
            <label class="form-check mb-0">
              <input class="form-check-input"
                     type="radio"
                     name="mode"
                     value="unico"
                {{ $currentMode === 'unico' ? 'checked' : '' }}>
              <span class="form-check-label">Único</span>
            </label>

            {{-- Opción planes mensuales/anueles --}}
            <label class="form-check mb-0">
              <input class="form-check-input"
                     type="radio"
                     name="mode"
                     value="mensual"
                {{ $currentMode === 'mensual' ? 'checked' : '' }}>
              <span class="form-check-label">Mensual / Anual</span>
            </label>
          </div>
        </div>
      </div>

      {{-- =========================================================
          BLOCK PLANES UNICO
          ========================================================= --}}
      <section id="blockUnico" style="{{ $currentMode === 'unico' ? '' : 'display:none;' }}">
        <h2 class="font-bankgothic mt-2">Plan Único</h2>

        <div id="planesAccordion">
          <div class="card  my-4 border-light">

            {{-- Collapsible para el plan único --}}
            <div class="card-header bg-azul">
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
                           value="{{ old('plans.unico.price', $unique->price ?? '0') }}"
                           placeholder="Ej: 1450">
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
                           value="{{ old('plans.unico.features', $uniqueFeatures ?? '') }}"
                           placeholder="Ej: Hosting, Dominio .com, SSL, Instalación">
                    <small class="text-blanco">Separá las características por coma.</small>
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
          ========================================================= --}}
      <section id="blockMensual" style="{{ $currentMode === 'mensual' ? '' : 'display:none;' }}">
        <h2 class="font-bankgothic mt-2">Planes anual / mensual</h2>
        <div id="planesAccordionMensual">

          {{-- =========================================================
                               PLAN BÁSICO
          ========================================================= --}}
          <div class="card my-4 border-light shadow-sm rounded-2">
            <div class="card-header bg-azul ">
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
                           value="{{ old('plans.basico.price', $precioBasico) ?? '0' }}">
                    @error('plans.basico.price')
                    <x-alert type="danger" :message="$message" small/>
                    @enderror
                  </div>

                  {{-- =========================================================
                       Descuento anual entre 0 y 99 porciento( revisar cuando es 100 xq da 0 el calculo)
                       ========================================================= --}}
                  <div class="col-md-4">
                    <label class="form-label">Descuento anual (%)</label>
                    <input type="number"
                           id="basico-discount"
                           name="plans[basico][discount]"
                           class="form-control"
                           min="0"
                           max="100"
                           step="1"
                           value="{{ old('plans.basico.discount', $descuentoBasico ?? '0') }}">
                  </div>

                  {{-- Precio anual calculado automáticamente con porcentaje y precio --}}
                  <div class="col-md-4">
                    <label class="form-label">Precio anual (U$D)</label>
                    <input type="number"
                           id="basico-annual-price"
                           class="form-control"
                           readonly>
                    <small class="text-blanco">Se calcula automáticamente según precio +
                      descuento.</small>
                  </div>

                  {{-- Características básicas --}}
                  <div class="col-12">
                    <label class="form-label">Características Básico</label>
                    <input type="text"
                           name="plans[basico][features]"
                           class="form-control"
                           value="{{ old('plans.basico.features', $featuresBasico) }}"
                           placeholder="Ej: Hosting, SSL, Soporte básico">
                    <small class="text-blanco">Separá las características por coma.</small>
                    @error('plans.basico.features')
                    <x-alert type="danger" :message="$message" small/>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{-- =========================================================
                            PLAN PROFESIONAL
               ========================================================= --}}
          <div class="card bg-azul border-light">
            <div class="card-header">
              <button
                class="btn btn-link text-light d-flex justify-content-between w-100 align-items-center p-0 text-decoration-none"
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
                           value="{{ old('plans.pro.price', $precioPro) ?? '0' }}"
                    >
                    @error('plans.pro.price')
                    <x-alert type="danger" :message="$message" small/>
                    @enderror
                  </div>

                  {{-- =========================================================
                  Descuento anual entre 0 y 99 porciento( revisar cuando es 100 xq da 0 el calculo)
                  ========================================================= --}}
                  <div class="col-md-4">
                    <label class="form-label">Descuento anual (%)</label>
                    <input type="number"
                           id="pro-discount"
                           name="plans[pro][discount]"
                           class="form-control"
                           min="0"
                           max="100"
                           step="1"
                           value="{{ old('plans.pro.discount', $descuentoPro) ?? '0' }}">
                  </div>

                  {{-- Precio anual calculado automáticamente --}}
                  <div class="col-md-4">
                    <label class="form-label">Precio anual (U$D)</label>
                    <input type="number"
                           id="pro-annual-price"
                           class="form-control"
                           readonly>
                    <small class="text-blanco">Se calcula automáticamente según precio +
                      descuento.</small>
                  </div>

                  {{-- Características Profesional --}}
                  <div class="col-12">
                    <label class="form-label">Características Profesional</label>
                    <input type="text"
                           name="plans[pro][features]"
                           class="form-control"
                           value="{{ old('plans.pro.features', $featuresPro ?? '') }}"
                           placeholder="Ej: Todo lo de Básico + extras">
                    <small class="text-blanco">Separá las características por coma.</small>
                    @error('plans.pro.features')
                    <x-alert type="danger" :message="$message" small/>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{-- =========================================================
                                      PLAN EMPRESARIAL
               ========================================================= --}}
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

            <div id="collapseEmpresarial" class="collapse" data-bs-parent="#planesAccordionMensual">
              <div class="card-body border-top border-light bg-azul-light text-light rounded-bottom-3">
                <div class="row g-3">
                  {{-- Precio mensual --}}
                  <div class="col-md-4">
                    <label class="form-label">Precio mensual (U$D)</label>
                    <input type="number"
                           id="empresarial-price"
                           name="plans[empresarial][price]"
                           class="form-control"
                           min="0"
                           step="0.01"
                           value="{{ old('plans.empresarial.price', $precioEmpresas) ?? '0' }}">
                    @error('plans.empresarial.price')
                    <x-alert type="danger" :message="$message" small/>
                    @enderror
                  </div>

                  {{-- =========================================================
                  Descuento anual entre 0 y 99 porciento( revisar cuando es 100 xq da 0 el calculo)
                  ========================================================= --}}
                  <div class="col-md-4">
                    <label class="form-label">Descuento anual (%)</label>
                    <input type="number"
                           id="empresarial-discount"
                           name="plans[empresarial][discount]"
                           class="form-control"
                           min="0"
                           max="100"
                           step="1"
                           value="{{ old('plans.empresarial.discount', $descuentoEmpresas) ?? '0' }}">
                  </div>

                  {{-- Precio anual automático --}}
                  <div class="col-md-4">
                    <label class="form-label">Precio anual (U$D)</label>
                    <input type="number"
                           id="empresarial-annual-price"
                           class="form-control"
                           readonly>
                    <small class="text-blanco">Se calcula automáticamente según mensual + descuento.</small>
                  </div>

                  {{-- Características Empresarial --}}
                  <div class="col-12">
                    <label class="form-label">Características Empresarial</label>
                    <input type="text"
                           name="plans[empresarial][features]"
                           class="form-control"
                           value="{{ old('plans.empresarial.features', $featuresEmpresarial ?? '') }}"
                           placeholder="Ej: Soporte prioritario, SLA, integraciones avanzadas">
                    <small class="text-blanco">Separá las características por coma.</small>
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
            <i class="fa-solid fa-xmark"></i> Cancelar
          </a>
          <button type="submit" class="btn btn-turquesa font-bankgothic px-4">
            <i class="fa-solid fa-floppy-disk"></i> Guardar cambios
          </button>
        </div>
      </div>

      <div class="d-flex justify-content-between align-items-center mt-4">
      </div>

    </form>
  </div>
@endsection

{{-- =========================================================
                          SCRIPTS
     ========================================================= --}}
@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // =========================================================
      // ícono en los collapsible
      // =========================================================

      document.querySelectorAll('.plan-toggle-icon').forEach((toggle) => {
        const targetId = toggle.dataset.target;
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
      // Mostrar / ocultar bloques según modo (Único / Mensual)
      // =========================================================
      const blockUnico = document.querySelector('#blockUnico');
      const blockMensual = document.querySelector('#blockMensual');
      const unicoRadio = document.querySelector('input[name="mode"][value="unico"]');
      const mensualRadio = document.querySelector('input[name="mode"][value="mensual"]');

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

      if (unicoRadio && mensualRadio) {
        unicoRadio.addEventListener('change', updateModeUI);
        mensualRadio.addEventListener('change', updateModeUI);
      }
      updateModeUI();

      // =========================================================
      // Cálculo automático de precios anuales
      // =========================================================
      /**
       * Configura el cálculo de precio anual:
       * - monthlySelector: input de precio mensual
       * - discountSelector: input de descuento (%)
       * - annualSelector: input donde se muestra el precio anual calculado
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

        monthly.addEventListener('input', recalc);
        discount.addEventListener('input', recalc);
        recalc();
      }

      setupAnnualCalc('#basico-price', '#basico-discount', '#basico-annual-price');
      setupAnnualCalc('#pro-price', '#pro-discount', '#pro-annual-price');
      setupAnnualCalc('#empresarial-price', '#empresarial-discount', '#empresarial-annual-price');

      // =========================================================
      // Confirmar antes de enviar el formulario
      // =========================================================

      const form = document.querySelector('#plansForm');
      if (form) {
        form.addEventListener('submit', async (e) => {
          e.preventDefault();
          const mode = (unicoRadio && unicoRadio.checked) ? 'unico' : 'mensual';
          const text = mode === 'unico'
            ? 'Vas a sobrescribir el Plan Único existente. ¿Confirmás guardar los cambios?'
            : 'Vas a actualizar los planes mensuales. ¿Confirmás guardar los cambios?';

          if (window.Swal) {
            const result = await Swal.fire({
              title: 'Confirmar guardado de planes',
              text: text,
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Sí, guardar',
              cancelButtonText: 'Cancelar',
              background: '#112b3a',
              color: '#cfd6dc',
              customClass: {
                popup: 'swal-custom-popup',
                title: 'swal-custom-title',
                confirmButton: 'swal-custom-confirm',
                cancelButton: 'swal-custom-cancel',
              },
            });
            if (result.isConfirmed) {
              form.submit();
            }
          } else {
            if (confirm(text)) {
              form.submit();
            }
          }
        });
      }
    })
    ;
  </script>
@endpush
