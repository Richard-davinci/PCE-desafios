@extends('layouts.app')

@section('title', 'Detalle del servicio')

@section('content')

        <section class="mt-3 py-5 bg-gradient-dark text-light">
            <div class="container">
                <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                    <div>
                        <h1 class="fs-1 fw-bold font-bankgothic mb-3">Hosting + Mantenimiento</h1>
                        <p class="text-blanco">Infra sólida, monitoreo 24/7 y horas de soporte incluidas para tu
                            web.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="container py-5">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card bg-azul text-light border-light shadow-sm h-100">
                        <div class="card-body">
                            <img src="../img/servicios/hosting.png" alt="Imagen representativa del servicio"
                                 class="img-fluid img-thumb mb-3">
                            <div class="service-meta small">
                                <div class="d-flex justify-content-between"><p>Duración</p><span>Mensual</span>
                                </div>
                                <div class="d-flex justify-content-between"><p>Estado</p><span
                                        class="text-success">Activo</span></div>
                                <div class="d-flex justify-content-between"><p>Última actualización</p>
                                    <span>05/07/2025</span>
                                </div>
                            </div>
                            <div class="d-grid mt-5">
                                <a href="contacto.html" class="btn btn-turquesa"><i class="bi bi-chat-dots me-1"></i>
                                    Consultar</a>
                            </div>
                        </div>
                    </div>


                </div>

                <!-- Col derecha: Descripción + Features + Planes -->
                <div class="col-lg-8">

                    <div class="card  bg-azul text-light border-light shadow-sm">
                        <div class="card-body">
                            <h2 class="fs-4 text-turquesa mb-2 font-bankgothic">Descripción</h2>
                            <p class="mb-3">
                                Servicio administrado de hosting con mantenimiento integral para sitios en producción.
                                Priorizamos performance (NVMe), seguridad (TLS, parches críticos) y continuidad (CI/CD
                                sin downtime),
                                con monitoreo 24/7 y soporte humano.
                            </p>

                            <div class="row g-3">
                                <div class="col-sm-6 ">
                                    <i class="bi bi-check2 me-2 text-turquesa"></i>VPS NVMe (2 vCPU / 4GB RAM)
                                </div>
                                <div class="col-sm-6 ">
                                    <i class="bi bi-check2 me-2 text-turquesa"></i>Nginx + PHP 8.2 + MariaDB
                                </div>
                                <div class="col-sm-6 ">
                                    <i class="bi bi-check2 me-2 text-turquesa"></i>SSL/TLS y firewall
                                </div>
                                <div class="col-sm-6 ">
                                    <i class="bi bi-check2 me-2 text-turquesa"></i>Backups diarios (30 días)
                                </div>
                                <div class="col-sm-6 ">
                                    <i class="bi bi-check2 me-2 text-turquesa"></i>Monitoreo 24/7 + alertas
                                </div>
                                <div class="col-sm-6 ">
                                    <i class="bi bi-check2 me-2 text-turquesa"></i>3 h de mantenimiento/mes
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Condiciones -->
                    <div class="card bg-azul text-light border-light shadow-sm mt-3">
                        <div class="card-body">
                            <h2 class="fs-4 text-turquesa font-bankgothic mb-2">Condiciones</h2>
                            <ul class=" small mb-0">
                                <li><p><i class="bi bi-check2 me-1 text-turquesa"></i>Facturación mensual por
                                        adelantado.</p></li>
                                <li><p><i class="bi bi-check2 me-1 text-turquesa"></i>Incluye 3 hs de mantenimiento/mes
                                        (no
                                        acumulables).</p></li>
                                <li><p><i class="bi bi-check2 me-1 text-turquesa"></i>Backups diarios con 30 días de
                                        retención.</p>
                                </li>
                                <li><p><i class="bi bi-check2 me-1 text-turquesa"></i>Cancelación al cierre del ciclo
                                        vigente.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 bg-gradient-dark text-light">
            <div class="container">
                <div class="row g-4">
                    <div class="col-12">
                        <!-- Planes del servicio (simple y limpio) -->
                        <div class="card bg-azul text-light border-light shadow-sm mt-3">
                            <div class="card-body">
                                <div
                                    class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 mb-2">
                                    <h2 class="fs-3 font-bankgothic text-turquesa mb-0">Planes disponibles</h2>

                                    <!-- Tabs -->
                                    <ul class="nav tabs-underline justify-content-center mb-0" id="planTabs"
                                        role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active font-bankgothic fs-5" id="mensual-tab"
                                                    data-bs-toggle="tab" data-bs-target="#mensual" type="button"
                                                    role="tab" aria-controls="mensual" aria-selected="true">
                                                Mensual
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link font-bankgothic fs-5" id="anual-tab"
                                                    data-bs-toggle="tab" data-bs-target="#anual" type="button"
                                                    role="tab" aria-controls="anual" aria-selected="false">
                                                Anual
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-content mt-4" id="planTabsContent">
                                    <!-- MENSUAL -->
                                    <div class="tab-pane fade show active" id="mensual" role="tabpanel"
                                         aria-labelledby="mensual-tab">
                                        <div class="row g-3">
                                            <!-- Clásico -->
                                            <div class="col-md-4">
                                                <div class="card rounded-3 h-100 p-3">
                                                    <h3 class="fs-4 font-bankgothic text-turquesa fw-bold mb-1">
                                                        Clásico</h3>
                                                    <p class="text-secondary small mb-2">Ideal para emprendedores</p>
                                                    <div class="price fs-3 mb-2">AR$ 8.999 <span
                                                            class="fs-6 text-secondary">/mes</span></div>
                                                    <p class="small text-secondary mb-3">Se renueva a AR$ 8.999/mes.</p>
                                                    <ul class="small ps-3 mb-3">
                                                        <li>Crear 1 sitio web</li>
                                                        <li>10 GB SSD</li>
                                                        <li>1 casilla de email por sitio (1 año)</li>
                                                        <li>SSL gratis</li>
                                                        <li>Backups automáticos semanales</li>
                                                    </ul>
                                                    <div class="d-grid">
                                                        <a href="./usuario/perfil.html" class="btn btn-turquesa mt-4">Elegir
                                                            plan</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Premium -->
                                            <div class="col-md-4">
                                                <div
                                                    class="card rounded-3 h-100 p-3 position-relative border border-light">
                                                      <span
                                                          class="position-absolute top-0 start-50 translate-middle badge bg-turquesa rounded-pill px-3"
                                                          style="transform: translate(-50%, -50%);">
                                                        MÁS VENDIDO
                                                      </span>
                                                    <h3 class="fs-4 font-bankgothic text-turquesa fw-bold mb-1">
                                                        Premium</h3>
                                                    <p class="text-secondary small mb-2">Todo lo que necesitás para
                                                        empezar</p>
                                                    <div class="price fs-3 mb-2">AR$ 13.699 <span
                                                            class="fs-6 text-secondary">/mes</span></div>
                                                    <p class="small text-secondary mb-3">Se renueva a AR$
                                                        13.699/mes.</p>
                                                    <ul class="small ps-3 mb-3">
                                                        <li>Hasta 25 sitios web</li>
                                                        <li>25 GB SSD</li>
                                                        <li>2 casillas de email por sitio (1 año)</li>
                                                        <li>Dominio gratis 1 año</li>
                                                        <li>WordPress siempre al día</li>
                                                        <li>Multisitio y línea de comandos</li>
                                                    </ul>
                                                    <div class="d-grid">
                                                        <a href="./usuario/perfil.html" class="btn btn-turquesa">Elegir
                                                            plan</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Empresarial -->
                                            <div class="col-md-4">
                                                <div class="card rounded-3 h-100 p-3">
                                                    <h3 class="fs-4 font-bankgothic text-turquesa fw-bold mb-1">
                                                        Empresarial</h3>
                                                    <p class="text-secondary small mb-2">Más herramientas y
                                                        crecimiento</p>
                                                    <div class="price fs-3 mb-2">AR$ 19.399 <span
                                                            class="fs-6 text-secondary">/mes</span></div>
                                                    <p class="small text-secondary mb-3">Se renueva a AR$
                                                        19.399/mes.</p>
                                                    <ul class="small ps-3 mb-3">
                                                        <li>Hasta 50 sitios web</li>
                                                        <li>50 GB NVMe</li>
                                                        <li>5 casillas de email por sitio (1 año)</li>
                                                        <li>Backups diarios y bajo demanda</li>
                                                        <li>CDN y velocidad máxima</li>
                                                        <li>Herramientas de IA para WordPress</li>
                                                    </ul>
                                                    <div class="d-grid">
                                                        <a href="./usuario/perfil.html" class="btn btn-turquesa">Elegir
                                                            plan</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ANUAL -->
                                    <div class="tab-pane fade" id="anual" role="tabpanel" aria-labelledby="anual-tab">
                                        <div class="row g-3">
                                            <!-- Clásico -->
                                            <div class="col-md-4">
                                                <div class="card rounded-3 h-100 p-3">
                                                    <h3 class="fs-4 font-bankgothic text-turquesa fw-bold mb-1">
                                                        Clásico</h3>
                                                    <p class="text-secondary small mb-2">Ideal para emprendedores</p>
                                                    <div class="price fs-3 mb-2">AR$ 89.990 <span
                                                            class="fs-6 text-secondary">/año</span></div>
                                                    <p class="small text-secondary mb-3">Equivale a AR$ 7.499/mes
                                                        aprox.</p>
                                                    <ul class="small ps-3 mb-3">
                                                        <li>Crear 1 sitio web</li>
                                                        <li>10 GB SSD</li>
                                                        <li>1 casilla de email por sitio (1 año)</li>
                                                        <li>SSL gratis</li>
                                                        <li>Backups automáticos semanales</li>
                                                    </ul>
                                                    <div class="d-grid">
                                                        <a href="./usuario/perfil.html" class="btn btn-turquesa">Contratar
                                                            anual</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Premium-->
                                            <div class="col-md-4">
                                                <div class="card rounded-3 h-100 p-3 position-relative">
                                                  <span
                                                      class="position-absolute top-0 start-50 translate-middle badge bg-turquesa rounded-pill px-3"
                                                      style="transform: translate(-50%, -50%);">
                                                    MÁS VENDIDO
                                                  </span>
                                                    <h3 class="fs-4 font-bankgothic text-turquesa fw-bold mb-1">
                                                        Premium</h3>
                                                    <p class="text-secondary small mb-2">Todo lo que necesitás para
                                                        empezar</p>
                                                    <div class="price fs-3 mb-2">AR$ 136.990 <span
                                                            class="fs-6 text-secondary">/año</span></div>
                                                    <p class="small text-secondary mb-3">Equivale a AR$ 11.415/mes
                                                        aprox.</p>
                                                    <ul class="small ps-3 mb-3">
                                                        <li>Hasta 25 sitios web</li>
                                                        <li>25 GB SSD</li>
                                                        <li>2 casillas de email por sitio (1 año)</li>
                                                        <li>Dominio gratis 1 año</li>
                                                        <li>WordPress siempre al día</li>
                                                        <li>Multisitio y línea de comandos</li>
                                                    </ul>
                                                    <div class="d-grid">
                                                        <a href="./usuario/perfil.html" class="btn btn-turquesa">Contratar
                                                            anual</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Empresarial -->
                                            <div class="col-md-4">
                                                <div class="card rounded-3 h-100 p-3">
                                                    <h3 class="fs-4 font-bankgothic text-turquesa fw-bold mb-1">
                                                        Empresarial</h3>
                                                    <p class="text-secondary small mb-2">Más herramientas y
                                                        crecimiento</p>
                                                    <div class="price fs-3 mb-2">AR$ 193.990 <span
                                                            class="fs-6 text-secondary">/año</span></div>
                                                    <p class="small text-secondary mb-3">Equivale a AR$ 16.165/mes
                                                        aprox.</p>
                                                    <ul class="small ps-3 mb-3">
                                                        <li>Hasta 50 sitios web</li>
                                                        <li>50 GB NVMe</li>
                                                        <li>5 casillas de email por sitio (1 año)</li>
                                                        <li>Backups diarios y bajo demanda</li>
                                                        <li>CDN y velocidad máxima</li>
                                                        <li>Herramientas de IA para WordPress</li>
                                                    </ul>
                                                    <div class="d-grid">
                                                        <a href="./usuario/perfil.html" class="btn btn-turquesa">Contratar
                                                            anual</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection
