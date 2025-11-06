@php
  $modalId      = $modalId      ?? 'planModal';
  $defaultMode  = $defaultMode  ?? 'unico'; // 'unico' | 'mensual'
  $isUpdate     = $isUpdate     ?? false;
  $formAction   = $formAction   ?? route('admin.plans.store', $service);

  // Helpers para valores (conserva old() si hubo validación)
  $val = function($key, $fallback = '') {
    return old($key, $fallback);
  };

  // Renderizar features como CSV si vienen como array
  $csv = function($features) {
    if (is_array($features)) return implode(', ', $features);
    if (is_string($features)) return $features;
    return '';
  };

  // Mostrar secciones según modo por defecto
  $showUnico    = $defaultMode === 'unico'   ? 'block' : 'none';
  $showMensual  = $defaultMode === 'mensual' ? 'block' : 'none';
@endphp

<form action="{{ $formAction }}" method="POST">
  @csrf
  @if($isUpdate) @method('PUT') @endif

  <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content text-light border-light shadow-lg">
        <div class="modal-header bg-azul">
          <h5 class="modal-title font-bankgothic fs-4" id="{{ $modalId }}Label">
            {{ $isUpdate ? 'Editar planes' : 'Crear planes' }} para {{ $service->name }}
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>

        <div class="modal-body mt-3">
          <div class="card shadow-sm rounded-2 bg-azul mb-3">
            <div class="card-body">
              <p class="mb-2">Elegí el tipo de plan:</p>
              <div class="d-flex gap-4 align-items-center">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="mode" id="modeUnico-{{ $modalId }}" value="unico"
                    {{ $val('mode', $defaultMode) === 'unico' ? 'checked' : '' }}>
                  <label class="form-check-label" for="modeUnico-{{ $modalId }}">Único</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="mode" id="modeMensual-{{ $modalId }}" value="mensual"
                    {{ $val('mode', $defaultMode) === 'mensual' ? 'checked' : '' }}>
                  <label class="form-check-label" for="modeMensual-{{ $modalId }}">Mensual (Básico, Profesional, Empresarial)</label>
                </div>
              </div>
            </div>
          </div>

          {{-- ÚNICO --}}
          <section id="blockUnico-{{ $modalId }}" style="display: {{ $showUnico }}">
            <div id="planesAccordion-{{ $modalId }}">
              <div class="card bg-azul mb-4">
                <div class="card-header">
                  <button
                    class="btn btn-link text-turquesa d-flex justify-content-between w-100 align-items-center p-0 text-decoration-none"
                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseUnico-{{ $modalId }}" aria-expanded="true"
                    aria-controls="collapseUnico-{{ $modalId }}">
                    <span class="font-bankgothic fs-5">Plan Único</span>
                    <span class="plan-toggle-icon" data-target="collapseUnico-{{ $modalId }}">
                      <i class="bi bi-chevron-down"></i>
                    </span>
                  </button>
                </div>
                <div id="collapseUnico-{{ $modalId }}" class="collapse show" data-bs-parent="#planesAccordion-{{ $modalId }}">
                  <div class="card-body border-top border-light">
                    <div class="row g-3">
                      <div class="col-md-6">
                        <label class="form-label">Plan</label>
                        <input class="form-control" value="Único" disabled>
                        {{-- En DB guardamos como "Empresarial" para respetar enum --}}
                        <input type="hidden" name="plans[0][name]" value="Empresarial">
                        <input type="hidden" name="plans[0][type]" value="único">
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Precio único (U$D)</label>
                        <input type="number" name="plans[0][price]" class="form-control" placeholder="Ej: 1450" min="0" step="1"
                               value="{{ $val('plans.0.price', $uniquePlan->price ?? '') }}">
                      </div>
                      <div class="col-12">
                        <label class="form-label">Características</label>
                        <input type="text" name="plans[0][features]" class="form-control"
                               placeholder="Ej: Hosting, Dominio .com, SSL, Instalación (Separadas por coma)"
                               value="{{ $val('plans.0.features', $csv($uniquePlan->features ?? null)) }}">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          {{-- MENSUALES (3 tiers) --}}
          <section id="blockMensual-{{ $modalId }}" class="mt-3" style="display: {{ $showMensual }}">
            <div id="planesAccordionMensual-{{ $modalId }}">

              {{-- BÁSICO --}}
              <div class="card bg-azul mb-4">
                <div class="card-header">
                  <button
                    class="btn btn-link text-turquesa d-flex justify-content-between w-100 align-items-center p-0 text-decoration-none"
                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseBasico-{{ $modalId }}" aria-expanded="false"
                    aria-controls="collapseBasico-{{ $modalId }}">
                    <span class="font-bankgothic fs-5">Básico</span>
                    <span class="plan-toggle-icon" data-target="collapseBasico-{{ $modalId }}">
                      <i class="bi bi-chevron-down"></i>
                    </span>
                  </button>
                </div>
                <div id="collapseBasico-{{ $modalId }}" class="collapse" data-bs-parent="#planesAccordionMensual-{{ $modalId }}">
                  <div class="card-body border-top border-light">
                    <div class="row g-3">
                      <div class="col-md-6 col-lg-4">
                        <label class="form-label">Plan</label>
                        <input class="form-control" value="Básico" disabled>
                        <input type="hidden" name="plans[0][name]" value="Básico">
                        <input type="hidden" name="plans[0][type]" value="mensual">
                      </div>
                      <div class="col-md-6 col-lg-4">
                        <label class="form-label">Precio mensual (U$D)</label>
                        <input type="number" name="plans[0][price]" class="form-control" placeholder="Ej: 19000" min="0" step="1"
                               value="{{ $val('plans.0.price', $pBasico->price ?? '') }}">
                      </div>
                      <div class="col-md-12 col-lg-4">
                        <label class="form-label">Descuento anual (%) <span class="text-secondary">(opcional)</span></label>
                        <input type="number" class="form-control" placeholder="Ej: 10" min="0" max="100" step="1">
                        <small class="text-secondary">Si lo dejás vacío: sin descuento.</small>
                      </div>
                      <div class="col-12">
                        <label class="form-label">Características básicas</label>
                        <input type="text" name="plans[0][features]" class="form-control"
                               placeholder="Ej: Hosting, SSL, Panel admin (Separadas por coma)"
                               value="{{ $val('plans.0.features', $csv($pBasico->features ?? null)) }}">
                        <small class="text-secondary">Base para Profesional y Empresarial.</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              {{-- PROFESIONAL (Pro en DB) --}}
              <div class="card bg-azul mb-4">
                <div class="card-header">
                  <button
                    class="btn btn-link text-turquesa d-flex justify-content-between w-100 align-items-center p-0 text-decoration-none"
                    type="button" data-bs-toggle="collapse" data-bs-target="#collapsePro-{{ $modalId }}" aria-expanded="false"
                    aria-controls="collapsePro-{{ $modalId }}">
                    <span class="font-bankgothic fs-5">Profesional</span>
                    <span class="plan-toggle-icon" data-target="collapsePro-{{ $modalId }}">
                      <i class="bi bi-chevron-down"></i>
                    </span>
                  </button>
                </div>
                <div id="collapsePro-{{ $modalId }}" class="collapse" data-bs-parent="#planesAccordionMensual-{{ $modalId }}">
                  <div class="card-body border-top border-light">
                    <div class="row g-3">
                      <div class="col-md-6 col-lg-4">
                        <label class="form-label">Plan</label>
                        <input class="form-control" value="Profesional" disabled>
                        <input type="hidden" name="plans[1][name]" value="Pro">
                        <input type="hidden" name="plans[1][type]" value="mensual">
                      </div>
                      <div class="col-md-6 col-lg-4">
                        <label class="form-label">Precio mensual (U$D)</label>
                        <input type="number" name="plans[1][price]" class="form-control" placeholder="Ej: 29000" min="0" step="1"
                               value="{{ $val('plans.1.price', $pPro->price ?? '') }}">
                      </div>
                      <div class="col-md-12 col-lg-4">
                        <label class="form-label">Descuento anual (%) <span class="text-secondary">(opcional)</span></label>
                        <input type="number" class="form-control" placeholder="Ej: 12" min="0" max="100" step="1">
                        <small class="text-secondary">Si lo dejás vacío: sin descuento.</small>
                      </div>
                      <div class="col-12">
                        <label class="form-label">Extras Pro</label>
                        <input type="text" id="proExtras-{{ $modalId }}" class="form-control"
                               placeholder="Ej: Soporte prioritario, Backups automáticos (Separadas por coma)">
                        {{-- Hidden final que viaja (combinamos en JS) --}}
                        <input type="hidden" id="proFeatures-{{ $modalId }}" name="plans[1][features]"
                               value="{{ $val('plans.1.features', $csv($pPro->features ?? null)) }}">
                        <small class="text-secondary">Se suman a las características básicas.</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              {{-- EMPRESARIAL --}}
              <div class="card bg-azul mb-4">
                <div class="card-header">
                  <button
                    class="btn btn-link text-turquesa d-flex justify-content-between w-100 align-items-center p-0 text-decoration-none"
                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseEmpresarial-{{ $modalId }}" aria-expanded="false"
                    aria-controls="collapseEmpresarial-{{ $modalId }}">
                    <span class="font-bankgothic fs-5">Empresarial</span>
                    <span class="plan-toggle-icon" data-target="collapseEmpresarial-{{ $modalId }}">
                      <i class="bi bi-chevron-down"></i>
                    </span>
                  </button>
                </div>
                <div id="collapseEmpresarial-{{ $modalId }}" class="collapse" data-bs-parent="#planesAccordionMensual-{{ $modalId }}">
                  <div class="card-body border-top border-light">
                    <div class="row g-3">
                      <div class="col-md-6 col-lg-4">
                        <label class="form-label">Plan</label>
                        <input class="form-control" value="Empresarial" disabled>
                        <input type="hidden" name="plans[2][name]" value="Empresarial">
                        <input type="hidden" name="plans[2][type]" value="mensual">
                      </div>
                      <div class="col-md-6 col-lg-4">
                        <label class="form-label">Precio mensual (U$D)</label>
                        <input type="number" name="plans[2][price]" class="form-control" placeholder="Ej: 49000" min="0" step="1"
                               value="{{ $val('plans.2.price', $pEmp->price ?? '') }}">
                      </div>
                      <div class="col-md-12 col-lg-4">
                        <label class="form-label">Descuento anual (%) <span class="text-secondary">(opcional)</span></label>
                        <input type="number" class="form-control" placeholder="Ej: 15" min="0" max="100" step="1">
                        <small class="text-secondary">Si lo dejás vacío: sin descuento.</small>
                      </div>
                      <div class="col-12">
                        <label class="form-label">Extras Empresarial</label>
                        <input type="text" id="empExtras-{{ $modalId }}" class="form-control"
                               placeholder="Ej: Gestor dedicado, SLA 24/7 (Separadas por coma)">
                        {{-- Hidden final que viaja (combinamos en JS) --}}
                        <input type="hidden" id="empFeatures-{{ $modalId }}" name="plans[2][features]"
                               value="{{ $val('plans.2.features', $csv($pEmp->features ?? null)) }}">
                        <small class="text-secondary">Se suman a básicas + extras Pro.</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </section>
        </div>

        <div class="modal-footer bg-azul">
          <button type="button" class="btn btn-outline-turquesa" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-turquesa font-bankgothic">{{ $isUpdate ? 'Guardar cambios' : 'Guardar' }}</button>
        </div>
      </div>
    </div>
  </div>
</form>

{{-- Scripts --}}
<script>
  // íconos de los collapses
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('#{{ $modalId }} .plan-toggle-icon').forEach(function (toggle) {
      const target = toggle.getAttribute('data-target');
      const el = document.getElementById(target);
      if (!el) return;
      el.addEventListener('show.bs.collapse', () => {
        toggle.querySelector('i')?.classList.replace('bi-chevron-down', 'bi-chevron-up');
      });
      el.addEventListener('hide.bs.collapse', () => {
        toggle.querySelector('i')?.classList.replace('bi-chevron-up', 'bi-chevron-down');
      });
    });
  });

  // alternar Único/Mensual según radios (por modalId)
  document.addEventListener('DOMContentLoaded', function () {
    const unicoRadio   = document.getElementById('modeUnico-{{ $modalId }}');
    const mensualRadio = document.getElementById('modeMensual-{{ $modalId }}');
    const blockUnico   = document.getElementById('blockUnico-{{ $modalId }}');
    const blockMensual = document.getElementById('blockMensual-{{ $modalId }}');

    function toggleSections() {
      if (unicoRadio.checked) {
        blockUnico.style.display   = 'block';
        blockMensual.style.display = 'none';
      } else {
        blockUnico.style.display   = 'none';
        blockMensual.style.display = 'block';
      }
    }
    toggleSections();
    unicoRadio.addEventListener('change', toggleSections);
    mensualRadio.addEventListener('change', toggleSections);
  });

  // Componer features para Pro y Empresarial al enviar (base + extras)
  document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById(@json($modalId));
    const form  = modal ? modal.closest('form') : null;
    if (!form) return;

    form.addEventListener('submit', function () {
      const isMensual = document.getElementById('modeMensual-{{ $modalId }}')?.checked;
      if (!isMensual) return;

      const base = (document.querySelector('#blockMensual-{{ $modalId }} input[name="plans[0][features]"]')?.value || '').trim();
      const pro  = (document.getElementById('proExtras-{{ $modalId }}')?.value || '').trim();
      const emp  = (document.getElementById('empExtras-{{ $modalId }}')?.value || '').trim();

      const join = (...parts) => parts.filter(Boolean).join(', ');

      const proHidden = document.getElementById('proFeatures-{{ $modalId }}');
      const empHidden = document.getElementById('empFeatures-{{ $modalId }}');

      if (proHidden) proHidden.value = join(base, pro);
      if (empHidden) empHidden.value = join(base, pro, emp);
    });
  });
</script>
