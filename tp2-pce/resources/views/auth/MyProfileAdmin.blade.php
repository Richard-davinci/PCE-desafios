@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container">
      <h1 class="fs-1 fw-bold font-bankgothic mb-3">Mi perfil de administrador</h1>
      <p class="text-blanco">Consultá tus datos y editá lo que necesites.</p>
    </div>
  </section>
  <section class="container">
    <x-breadcrumb :items="[['label' => 'Inicio',   'route' => 'pages.index'],  ['label' => 'perfil']]"
                  separator="›"/>
  </section>

  <section class=" py-5 container">
    <div class="mb-4">
      <div class="row g-4">
        <div class="col-lg-4">
          <div class="card bg-azul text-light border-light card-section mb-3">
            <div class="card-body text-center">
              <img src="img/ricardo.webp" alt="Tu avatar" height="169" width="169"
                   class="avatar-lg mx-auto mb-3 border border-secondary">
              <div class="d-grid gap-2">
                <label class="btn btn-turquesa mb-0">
                  <i class="bi bi-image me-1"></i> Cambiar foto
                  <input type="file" accept="image/*" hidden>
                </label>
              </div>
            </div>
          </div>

          <div class="card bg-azul text-light border-light card-section">
            <div class="card-body">
              <h2 class="fs-5 text-turquesa mb-3">Estado de la cuenta</h2>
              <ul class="list-unstyled mb-0 small">
                <li class="d-flex align-items-center justify-content-between">
                  <span>Verificación de email</span>
                  <span class="badge text-bg-success p-2">OK</span>
                </li>
              </ul>
              <div class="d-grid gap-2 mt-3">
                <button class="btn btn-turquesa" data-bs-toggle="modal"
                        data-bs-target="#modalPassword">
                  <i class="bi bi-shield-lock me-1"></i> Cambiar contraseña
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-8">
          <div class="card bg-azul text-light border-light h-100">
            <div class="card-body pt-0">
              <ul class="nav tabs-underline justify-content-center mb-2" id="profileTabs"
                  role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active font-bankgothic fs-5" id="ver-tab"
                          data-bs-toggle="tab"
                          data-bs-target="#ver" type="button" role="tab">Datos
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link font-bankgothic fs-5" id="editar-tab"
                          data-bs-toggle="tab"
                          data-bs-target="#editar" type="button" role="tab">Editar Datos
                  </button>
                </li>
              </ul>

              <div class="tab-content" id="profileTabsContent">
                <div class="tab-pane fade show active" id="ver" role="tabpanel"
                     aria-labelledby="ver-tab">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <small class="text-turquesa">Nombre</small>
                      <div class="readonly-value">Ricardo Rodolfo</div>
                    </div>
                    <div class="col-md-6">
                      <small class="text-turquesa">Apellido</small>
                      <div class="readonly-value">Garcia</div>
                    </div>
                    <div class="col-md-6">
                      <small class="text-turquesa">Email</small>
                      <div class="readonly-value">ricardo.garcia@davinci.edu.ar</div>
                    </div>
                    <div class="col-md-6">
                      <small class="text-turquesa">Teléfono</small>
                      <div class="readonly-value">+54 221 690-5085</div>
                    </div>
                    <div class="col-md-6">
                      <small class="text-turquesa">Ciudad</small>
                      <div class="readonly-value">La Plata</div>
                    </div>
                  </div>
                </div>

                <div class="tab-pane fade" id="editar" role="tabpanel" aria-labelledby="editar-tab">
                  <form class="row g-3 needs-validation" action="#" method="post" novalidate>
                    <div class="col-md-6">
                      <label class="form-label" for="fNombre">Nombre</label>
                      <input id="fNombre" name="nombre" class="form-control"
                             value="Ricardo Rodolfo" required>
                      <div class="invalid-feedback">Ingresá tu nombre.</div>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="fApellido">Apellido</label>
                      <input id="fApellido" name="apellido" class="form-control"
                             value="Garcia"
                             required>
                      <div class="invalid-feedback">Ingresá tu apellido.</div>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="fEmail">Email</label>
                      <input id="fEmail" name="email" type="email" class="form-control"
                             value="ricardo.garcia@davinci.edu.ar" required>
                      <div class="invalid-feedback">Ingresá un email válido.</div>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="fTelefono">Teléfono</label>
                      <input id="fTelefono" name="telefono" class="form-control"
                             value="+54 221 690-5085">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="fCiudad">Ciudad</label>
                      <input id="fCiudad" name="ciudad" class="form-control" value="La Plata">
                    </div>
                    <div class="col-12 d-grid d-sm-flex gap-3 mt-2">
                      <button class="btn btn-turquesa" type="submit">Guardar cambios</button>
                    </div>
                  </form>
                </div>
              </div> <!-- /tab-content -->
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>

  <!-- MODAL Cambiar contraseña -->
  <div class="modal fade" id="modalPassword" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content border-light">
        <div class="modal-header bg-azul text-light ">
          <h2 class="modal-title fs-5">Cambiar contraseña</h2>
          <button class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <form class="modal-body needs-validation" action="#" method="post" novalidate>
          <div class="mb-3">
            <label class="form-label" for="oldPass">Contraseña actual</label>
            <input type="password" id="oldPass" name="old_password" class="form-control" required
                   minlength="6">
            <div class="invalid-feedback">Ingresá tu contraseña actual.</div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="newPass">Nueva contraseña</label>
            <input type="password" id="newPass" name="new_password" class="form-control" required
                   minlength="6">
            <div class="invalid-feedback">Mínimo 6 caracteres.</div>
          </div>
          <div class="mb-1">
            <label class="form-label" for="newPass2">Repetir nueva contraseña</label>
            <input type="password" id="newPass2" name="new_password_repeat" class="form-control" required
                   minlength="6">
            <div class="invalid-feedback">Repetí la contraseña.</div>
          </div>
        </form>
        <div class="modal-footer bg-azul text-light px-0">
          <button class="btn btn-outline-light" data-bs-dismiss="modal" type="button">Cancelar</button>
          <button class="btn btn-turquesa" type="submit">Actualizar</button>
        </div>
      </div>
    </div>
  </div>

@endsection

