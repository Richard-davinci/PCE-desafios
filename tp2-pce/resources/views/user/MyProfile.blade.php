<x-layout>
    <x-slot:title>Mi perfil</x-slot:title>
    <main class="my-5">
        <section class="mt-3 py-5 bg-gradient-dark text-light">
            <div class="container">
                <h1 class="fs-1 fw-bold font-bankgothic mb-3">Mi perfil</h1>
                <p class="text-blanco">Consultá tus datos y editá lo que necesites.</p>
            </div>
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

        <section class=" py-5 bg-azul">
            <div class="container">

                <div class="mb-4">
                    <h1 class="fs-2 font-bankgothic fw-bold">Mi suscripción</h1>
                </div>

                <div class="row g-4">
                    <!-- Col izquierda -->
                    <div class="col-lg-4">
                        <!-- Resumen de suscripción -->
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h2 class="fs-5 fw-bold mb-1">Resumen de suscripción</h2>

                                <div class="mb-3">
                                    <small class="fw-bold d-block">Servicio</small>
                                    <p class="mb-1">Hosting + Mantenimiento Arte-sano</p>

                                    <small class="fw-bold d-block">Plan</small>
                                    <p class="mb-1" id="currentPlan">Pro mensual</p>

                                    <small class="fw-bold d-block">Add-ons</small>
                                    <p class="mb-1">CDN • Backups diarios • Monitoreo 24/7 • Soporte prioritario</p>

                                    <small class="fw-bold d-block">Dominio</small>
                                    <p class="mb-1">artesano-beer.com</p>

                                    <small class="fw-bold d-block">Usuarios / Seats</small>
                                    <p class="mb-1">2 de 5 usados</p>
                                </div>

                                <hr class="border-secondary">

                                <div class="mb-3">
                                    <small class="fw-bold d-block">Método de pago</small>
                                    <p class="mb-1">Mercado Pago — VISA •••• 1234</p>

                                    <small class="fw-bold d-block">Próxima facturación</small>
                                    <p class="mb-1">05/08/2025 — <span id="currentBilling">$69.900</span></p>

                                    <span class="badge text-bg-success p-2">Activa</span>
                                </div>

                                <div class="d-grid gap-2">
                                    <button class="btn btn-turquesa" data-bs-toggle="modal"
                                            data-bs-target="#modalChangePlan">
                                        Cambiar plan
                                    </button>
                                    <button class="btn btn-outline-turquesa" data-bs-toggle="modal"
                                            data-bs-target="#modalCancel">
                                        Cancelar suscripción
                                    </button>
                                </div>
                            </div>
                        </div>


                        <div class="card  shadow-sm mt-3">
                            <div class="card-body">
                                <h2 class="fs-6 fw-bold mb-3">Otros servicios activos</h2>
                                <ul class="list-unstyled mb-0 small">
                                    <li class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary">
                                        <div>
                                            <i class="bi bi-megaphone me-2 fw-bold"></i>
                                            Landing promocional
                                            <span class="d-block text-secondary small">Básico anual</span>
                                        </div>
                                        <a href="#" class="btn btn-sm btn-outline-light">Ver</a>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center py-2">
                                        <div>
                                            <i class="bi bi-cart-check me-2 fw-bold"></i>
                                            Hosting ecommerce
                                            <span class="d-block text-secondary small">Pro mensual</span>
                                        </div>
                                        <a href="#" class="btn btn-sm btn-outline-light">Ver</a>
                                    </li>
                                </ul>
                            </div>
                        </div>


                    </div>

                    <!-- Col derecha -->
                    <div class="col-lg-8">
                        <!-- Detalle del servicio / plan -->
                        <div class="card  shadow-sm">
                            <div class="card-body">
                                <div
                                    class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2">
                                    <div>
                                        <h2 class="fs-5 fw-bold mb-1">Detalle del servicio</h2>
                                        <ul class="mb-0 small ps-3">
                                            <li>Infraestructura: VPS NVMe (2 vCPU, 4GB RAM), Nginx + PHP 8.2 + MariaDB
                                            </li>
                                            <li>Despliegues: CI/CD con releases sin downtime</li>
                                            <li>Seguridad: SSL/TLS, firewall, actualizaciones críticas</li>
                                            <li>Backups: diarios (30 días de retención) + restauración bajo demanda</li>
                                            <li>Monitoreo 24/7: uptime, recursos y alertas por email/WhatsApp</li>
                                            <li>Horas de mantenimiento incluidas: 3 h/mes</li>
                                        </ul>
                                    </div>
                                    <a class="btn btn-turquesa mt-3 mt-md-0" href="{{route('pages.viewService')}}">Ver
                                        servicio</a>
                                </div>
                            </div>
                        </div>


                        <!-- Historial de pagos -->
                        <div class="card shadow-sm mt-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h2 class="fs-5 fw-bold mb-0">Historial de pagos</h2>
                                    <span class="badge text-bg-success">Al día</span>
                                </div>

                                <div class="table-responsive mt-3">
                                    <table class="table table-striped align-middle  mb-0">
                                        <thead class="table-dark">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Servicio</th>
                                            <th>Descripción</th>
                                            <th>Monto</th>
                                            <th>Estado</th>
                                            <th>Factura</th>
                                        </tr>
                                        </thead>
                                        <tbody id="paymentsBody">
                                        <tr>
                                            <td>05/07/2025</td>
                                            <td>Hosting + Mantenimiento Arte-sano</td>
                                            <td>Plan Pro mensual</td>
                                            <td>$69.900</td>
                                            <td><span class="badge text-bg-success p-2">Pagado</span></td>
                                            <td><a class="btn btn-sm btn-turquesa" href="#">Descargar</a></td>
                                        </tr>
                                        <tr>
                                            <td>05/06/2025</td>
                                            <td>Hosting + Mantenimiento Arte-sano</td>
                                            <td>Plan Pro mensual</td>
                                            <td>$69.900</td>
                                            <td><span class="badge text-bg-success p-2">Pagado</span></td>
                                            <td><a class="btn btn-sm btn-turquesa" href="#">Descargar</a></td>
                                        </tr>
                                        <tr>
                                            <td>05/05/2025</td>
                                            <td>Hosting + Mantenimiento Arte-sano</td>
                                            <td>Plan Pro mensual</td>
                                            <td>$69.900</td>
                                            <td><span class="badge text-bg-success p-2">Pagado</span></td>
                                            <td><a class="btn btn-sm btn-turquesa" href="#">Descargar</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
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
                        <input type="password" id="oldPass" name="old_password" class="form-control" required minlength="6">
                        <div class="invalid-feedback">Ingresá tu contraseña actual.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="newPass">Nueva contraseña</label>
                        <input type="password" id="newPass" name="new_password" class="form-control" required minlength="6">
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


    <!-- MODALES suscripciones -->
    <div class="modal fade" id="modalChangePlan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-light">
                <div class="modal-header bg-azul text-light">
                    <h2 class="modal-title fs-5">Cambiar plan</h2>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p class="">Elegí el nuevo plan:</p>
                    <div class="vstack gap-2">
                        <div class="form-check"><input class="form-check-input" type="radio" name="planOpt" id="optStarter"
                                                       value="Starter"><label class="form-check-label"
                                                                              for="optStarter">Starter</label></div>
                        <div class="form-check"><input class="form-check-input" type="radio" name="planOpt" id="optPro"
                                                       value="Pro"><label class="form-check-label" for="optPro">Pro</label></div>
                        <div class="form-check"><input class="form-check-input" type="radio" name="planOpt" id="optPremium"
                                                       value="Premium"><label class="form-check-label"
                                                                              for="optPremium">Premium</label></div>
                    </div>
                </div>
                <div class="modal-footer bg-azul text-light">
                    <button class="btn btn-outline-turquesa" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-turquesa" id="confirmChangePlan">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCancel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-light">
                <div class="modal-header bg-azul">
                    <h2 class="modal-title fs-5">Cancelar suscripción</h2>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">La cancelación se aplicará al <strong>fin del ciclo</strong>. ¿Confirmás?</p>
                </div>
                <div class="modal-footer bg-azul">
                    <button class="btn btn-outline-turquesa" data-bs-dismiss="modal">Volver</button>
                    <button class="btn btn-danger" id="confirmCancel">Confirmar cancelación</button>
                </div>
            </div>
        </div>
    </div>
</x-layout>
