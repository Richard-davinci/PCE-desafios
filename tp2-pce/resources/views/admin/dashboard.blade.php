@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
        <section
            class="mt-3 py-5 bg-gradient-dark text-light ">
            <div class="container d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2">
                <div class="mb-4">
                    <h1 id="pageTitle" class="fs-1 font-bankgothic fw-bold mb-1">Dashboard</h1>
                    <p class="text-blanco mb-0">Resumen general del sitio.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{route('services.index')}}" class="btn btn-outline-light"><i class="bi bi-gear me-1"></i> Servicios</a>
                  <a href="{{route('admin.admin')}}" class="btn btn-outline-light"><i class="bi bi-gear me-1"></i> Ir
                        al Admin</a>
                    <button class="btn btn-turquesa"><i class="bi bi-arrow-clockwise me-1"></i> Actualizar</button>
                </div>
            </div>
        </section>

        <!-- KPIs -->
        <section class=" container my-5">
            <h2 id="kpisTitle" class="visually-hidden">Indicadores</h2>
            <div class="row g-3">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card bg-azul text-light border-light h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <small class="text-blanco d-block">Usuarios totales</small>
                                    <div class="fs-3 fw-bold">128</div>
                                </div>
                                <span class="badge text-bg-success">+6 hoy</span>
                            </div>
                            <div class="progress mt-3" style="height:6px;">
                                <div class="progress-bar bg-success" style="width:65%"></div>
                            </div>
                            <div class="small text-blanco mt-1">Meta mensual: 200</div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card bg-azul text-light border-light h-100">
                        <div class="card-body">
                            <small class="text-blanco d-block">Servicios activos</small>
                            <div class="fs-3 fw-bold">9</div>
                            <div class="mt-2">
                                <span class="badge text-bg-info me-1">Infra 3</span>
                                <span class="badge text-bg-secondary me-1">Web 5</span>
                                <span class="badge text-bg-dark">Mkt 1</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card bg-azul text-light border-light h-100">
                        <div class="card-body">
                            <small class="text-blanco d-block">Ingresos estimados (mes)</small>
                            <div class="fs-3 fw-bold">AR$ 1.245.000</div>
                            <div class="progress mt-3" style="height:6px;">
                                <div class="progress-bar" style="width:48%"></div>
                            </div>
                            <div class="small text-blanco mt-1">48% de la meta</div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card bg-azul text-light border-light h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <small class="text-blanco d-block">Tickets abiertos</small>
                                    <div class="fs-3 fw-bold">4</div>
                                </div>
                                <span class="badge text-bg-warning">Pendientes</span>
                            </div>
                            <ul class="list-unstyled small mt-2 mb-0">
                                <li>• Migración WP — <span class="text-blanco">Alta</span></li>
                                <li>• DNS — <span class="text-blanco">Media</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Dos columnas -->
        <section class="container my-5">
            <div class="row g-3 my-5">
                <!-- Columna izquierda -->
                <div class="col-12 col-lg-6">
                    <!-- Actividad reciente -->
                    <div class="card bg-azul text-light border-light mb-3">
                        <div class="card-body">
                            <h3 class="fs-5 font-bankgothic text-turquesa mb-3">Actividad reciente</h3>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item bg-azul text-light border-light d-flex justify-content-between">
                                    <span><i class="bi bi-person-plus me-2 text-turquesa"></i>Nuevo usuario: <strong>Ana Gómez</strong></span>
                                    <span class="text-blanco small">hace 2 h</span>
                                </li>
                                <li class="list-group-item bg-azul text-light border-light d-flex justify-content-between">
                                    <span><i class="bi bi-bag-check me-2 text-turquesa"></i>Alta de servicio: <strong>Hosting + Mant.</strong></span>
                                    <span class="text-blanco small">hace 5 h</span>
                                </li>
                                <li class="list-group-item bg-azul text-light border-light d-flex justify-content-between">
                                    <span><i class="bi bi-credit-card me-2 text-turquesa"></i>Pago acreditado: <strong>Pro mensual</strong></span>
                                    <span class="text-blanco small">ayer</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Vencimientos -->
                    <div class="card bg-azul text-light border-light">
                        <div class="card-body">
                            <h3 class="fs-5 font-bankgothic text-turquesa mb-3">Suscripciones que vencen pronto</h3>
                            <div class="table-responsive">
                                <table class="table table-dark table-striped align-middle mb-0">
                                    <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Servicio</th>
                                        <th>Plan</th>
                                        <th>Vencimiento</th>
                                        <th class="text-end">Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Juan Pérez</td>
                                        <td>Hosting + Mant.</td>
                                        <td>Pro mensual</td>
                                        <td>12/09</td>
                                        <td class="text-end"><a href="../views/usuario/perfil.html"
                                                                class="btn btn-sm btn-outline-turquesa">Ver</a></td>
                                    </tr>
                                    <tr>
                                        <td>Laura Díaz</td>
                                        <td>Landing</td>
                                        <td>Único</td>
                                        <td>15/09</td>
                                        <td class="text-end"><a href="../views/usuario/perfil.html"
                                                                class="btn btn-sm btn-outline-turquesa">Ver</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Columna derecha -->
                <div class="col-12 col-lg-6">
                    <!-- Top servicios -->
                    <div class="card bg-azul text-light border-light mb-3">
                        <div class="card-body">
                            <h3 class="fs-5 font-bankgothic text-turquesa mb-3">Top servicios (por ingresos)</h3>
                            <div class="table-responsive">
                                <table class="table table-dark table-striped align-middle mb-0">
                                    <thead>
                                    <tr>
                                        <th>Servicio</th>
                                        <th class="text-end">AR$ / mes</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Hosting + Mantenimiento</td>
                                        <td class="text-end">680.000</td>
                                    </tr>
                                    <tr>
                                        <td>Sitio institucional</td>
                                        <td class="text-end">420.000</td>
                                    </tr>
                                    <tr>
                                        <td>Landing / Maquetación</td>
                                        <td class="text-end">145.000</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Últimos usuarios -->
                    <div class="card bg-azul text-light border-light mb-3">
                        <div class="card-body">
                            <h3 class="fs-5 font-bankgothic text-turquesa mb-3">Últimos usuarios</h3>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item bg-azul text-light border-light d-flex align-items-center justify-content-between">
                                <span><img src="../assets/img/ricardo.webp"
                                           class="avatar-sm border border-secondary me-2" alt=""> Ana Gómez</span>
                                    <span class="badge text-bg-success">Nuevo</span>
                                </li>
                                <li class="list-group-item bg-azul text-light border-light d-flex align-items-center justify-content-between">
                                <span><img src="../assets/img/ricardo.webp"
                                           class="avatar-sm border border-secondary me-2" alt=""> Marcos Ruiz</span>
                                    <span class="text-blanco small">ayer</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <!-- Estado del sistema -->
                <div class="card bg-azul text-light border-light">
                    <div class="card-body">
                        <h3 class="fs-5 font-bankgothic text-turquesa mb-3">Estado del sistema</h3>
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="p-3 border rounded-3 h-100">
                                    <div class="d-flex justify-content-between">
                                        <span>API</span>
                                        <span class="badge text-bg-success">OK</span>
                                    </div>
                                    <div class="progress mt-2" style="height:6px;">
                                        <div class="progress-bar bg-success" style="width:100%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 border rounded-3 h-100">
                                    <div class="d-flex justify-content-between">
                                        <span>Servidor correo</span>
                                        <span class="badge text-bg-warning">Lento</span>
                                    </div>
                                    <div class="progress mt-2" style="height:6px;">
                                        <div class="progress-bar bg-warning" style="width:45%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="p-3 border rounded-3">
                                    <div class="d-flex justify-content-between">
                                        <span>Uptime últimos 30 días</span>
                                        <span class="text-blanco">99.4%</span>
                                    </div>
                                    <div class="progress mt-2" style="height:6px;">
                                        <div class="progress-bar" style="width:94%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        </div>
@endsection
