@php
  $modalId = $modalId ?? 'planModal';
@endphp
<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-modal="true"
     role="dialog">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content text-light border-light shadow-lg">
      <div class="modal-header bg-azul">
        <h5 class="modal-title font-bankgothic fs-4" id="{{ $modalId }}Label">Crear planes para {{$service->name}}</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body mt-3">
        <div class="card shadow-sm rounded-2 bg-azul mb-3">
          <div class="card-body">
            <p class="mb-2">Elegí el tipo de plan:</p>
            <div class="d-flex gap-4 align-items-center">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="mode" id="modeUnico" value="unico" checked>
                <label class="form-check-label" for="modeUnico">Único</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="mode" id="modeMensual" value="mensual">
                <label class="form-check-label" for="modeMensual">Mensual (Básico, Profesional, Empresarial)</label>
              </div>
            </div>
          </div>
        </div>

        <!-- ÚNICO -->
        <section id="blockUnico">
          <div id="planesAccordion">
            <div class="card bg-azul mb-4">
              <div class="card-header">
                <button
                  class="btn btn-link text-turquesa d-flex justify-content-between w-100 align-items-center p-0 text-decoration-none"
                  type="button" data-bs-toggle="collapse" data-bs-target="#collapseUnico" aria-expanded="false"
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
                      <label class="form-label">Plan</label>
                      <input class="form-control" value="Único" disabled>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Precio único (U$D)</label>
                      <input type="number" class="form-control" placeholder="Ej: 1450" min="0" step="1">
                    </div>
                    <div class="col-12">
                      <label class="form-label">Características</label>
                      <input type="text" class="form-control"
                             placeholder="Ej: Hosting, Dominio .com, SSL, Instalación (Separadas por coma)">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- MENSUALES -->
        <section id="blockMensual" class="mt-3" style="display:none;">
          <div id="planesAccordionMensual">
            <!-- BASICO -->
            <div class="card bg-azul mb-4">
              <div class="card-header">
                <button
                  class="btn btn-link text-turquesa d-flex justify-content-between w-100 align-items-center p-0 text-decoration-none"
                  type="button" data-bs-toggle="collapse" data-bs-target="#collapseBasico" aria-expanded="true"
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
                    <div class="col-md-6 col-lg-4">
                      <label class="form-label">Plan</label>
                      <input class="form-control" value="Básico" disabled>
                    </div>
                    <div class="col-md-6 col-lg-4">
                      <label class="form-label">Precio mensual (U$D)</label>
                      <input type="number" class="form-control" placeholder="Ej: 19000" min="0" step="1">
                    </div>
                    <div class="col-md-12 col-lg-4">
                      <label class="form-label">Descuento anual (%) <span
                          class="text-secondary">(opcional)</span></label>
                      <input type="number" class="form-control" placeholder="Ej: 10" min="0" max="100" step="1">
                      <small class="text-secondary">Si lo dejás vacío: sin descuento.</small>
                    </div>
                    <div class="col-12">
                      <label class="form-label">Características básicas</label>
                      <input type="text" class="form-control"
                             placeholder="Ej:Hosting, SSL, Panel admin (Separadas por coma)">
                      <small class="text-secondary">Estas son la base para Profesional y Empresarial.</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- PROFESIONAL -->
            <div class="card bg-azul mb-4">
              <div class="card-header">
                <button
                  class="btn btn-link text-turquesa d-flex justify-content-between w-100 align-items-center p-0 text-decoration-none"
                  type="button" data-bs-toggle="collapse" data-bs-target="#collapsePro" aria-expanded="false"
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
                    <div class="col-md-6 col-lg-4">
                      <label class="form-label">Plan</label>
                      <input class="form-control" value="Profesional" disabled>
                    </div>
                    <div class="col-md-6 col-lg-4">
                      <label class="form-label">Precio mensual (U$D)</label>
                      <input type="number" class="form-control" placeholder="Ej: 29000" min="0" step="1">
                    </div>
                    <div class="col-md-12 col-lg-4">
                      <label class="form-label">Descuento anual (%) <span
                          class="text-secondary">(opcional)</span></label>
                      <input type="number" class="form-control" placeholder="Ej: 12" min="0" max="100" step="1">
                      <small class="text-secondary">Si lo dejás vacío: sin descuento.</small>
                    </div>
                    <div class="col-12">
                      <label class="form-label">Características Profesional</label>
                      <input type="text" class="form-control"
                             placeholder="Ej: Soporte prioritario, Backups automáticos (Separadas por coma)">
                      <small class="text-secondary">Adicional respecto al Básico.</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- EMPRESARIAL -->
            <div class="card bg-azul mb-4">
              <div class="card-header">
                <button
                  class="btn btn-link text-turquesa d-flex justify-content-between w-100 align-items-center p-0 text-decoration-none"
                  type="button" data-bs-toggle="collapse" data-bs-target="#collapseEmpresarial"
                  aria-expanded="false" aria-controls="collapseEmpresarial">
                  <span class="font-bankgothic fs-5">Empresarial</span>
                  <span class="plan-toggle-icon" data-target="collapseEmpresarial">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </button>
              </div>
              <div id="collapseEmpresarial" class="collapse" data-bs-parent="#planesAccordionMensual">
                <div class="card-body border-top border-light">
                  <div class="row g-3">
                    <div class="col-md-6 col-lg-4">
                      <label class="form-label">Plan</label>
                      <input class="form-control" value="Empresarial" disabled>
                    </div>
                    <div class="col-md-6 col-lg-4">
                      <label class="form-label">Precio mensual (U$D)</label>
                      <input type="number" class="form-control" placeholder="Ej: 49000" min="0" step="1">
                    </div>
                    <div class="col-md-12 col-lg-4">
                      <label class="form-label">Descuento anual (%) <span
                          class="text-secondary">(opcional)</span></label>
                      <input type="number" class="form-control" placeholder="Ej: 15" min="0" max="100" step="1">
                      <small class="text-secondary">Si lo dejás vacío: sin descuento.</small>
                    </div>
                    <div class="col-12">
                      <label class="form-label">Características Empresarial</label>
                      <input type="text" class="form-control"
                             placeholder="Ej: Gestor dedicado, SLA 24/7 (Separadas por coma)">
                      <small class="text-secondary">Adicional respecto a Básico y Profesional.</small>
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
        <button type="button" class="btn btn-turquesa font-bankgothic">Guardar</button>
      </div>
    </div>
  </div>
</div>

<script>
  //para cambiar contraer los collapsibles
  document.addEventListener('DOMContentLoaded', function () {
    let toggles = document.querySelectorAll('.plan-toggle-icon');
    toggles.forEach(function (toggle) {
      let target = toggle.getAttribute('data-target');
      let collapseEl = document.getElementById(target);
      collapseEl.addEventListener('show.bs.collapse', function () {
        toggle.querySelector('i').classList.remove('bi-chevron-down');
        toggle.querySelector('i').classList.add('bi-chevron-up');
      });
      collapseEl.addEventListener('hide.bs.collapse', function () {
        toggle.querySelector('i').classList.remove('bi-chevron-up');
        toggle.querySelector('i').classList.add('bi-chevron-down');
      });
    });
  });
  //para cambiar la viosta de los radios()
  document.addEventListener('DOMContentLoaded', function () {
    const unicoRadio = document.querySelector('#modeUnico');
    const mensualRadio = document.querySelector('#modeMensual');

    const blockUnico = document.querySelector('#blockUnico');
    const blockMensual = document.querySelector('#blockMensual');

    function toggleSections() {
      const display = unicoRadio.checked ? {
        blockUnico: 'block',
        blockMensual: 'none'
      } : {
        blockUnico: 'none',
        blockMensual: 'block'
      };

      blockUnico.style.display = display.blockUnico;
      blockMensual.style.display = display.blockMensual;
    }

    toggleSections();

    unicoRadio.addEventListener('change', toggleSections);
    mensualRadio.addEventListener('change', toggleSections);
  });

</script>


