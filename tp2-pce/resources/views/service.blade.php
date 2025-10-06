<x-layout>
    <main class="mt-5">
        <section class="mt-3 py-5 bg-gradient-dark text-light">
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <h1 class="fs-1 font-bankgothic fw-bold mb-2">
                            Servicios web que mueven la aguja
                        </h1>
                        <p class="text-blanco mb-4">
                            Elegí el alcance que mejor te calza: sitio institucional, landing,
                            CMS, formularios, SEO y mantenimiento.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5">
            <div class="container">
                <div class="mb-4">
                    <h2 class="fs-2 font-bankgothic fw-bold">Servicios</h2>
                    <p class="text-gris mb-0">Servicios clave para tu presencia digital.</p>
                </div>

                <div class="row g-4">

                    <div class="col-md-6 col-lg-4">
                        <article class="card bg-azul text-light border-light shadow-sm service-card">
                            <img src="../img/servicios/hosting.png"
                                 class="card-img-top" alt="Servicio de hosting y mantenimiento web"
                                 loading="lazy" decoding="async">
                            <div class="card-body">
                                <h3 class="font-bankgothic fs-4">Hosting + Mantenimiento</h3>
                                <p class="text-blanco">
                                    Servicio completo de alojamiento web con monitoreo 24/7, backups diarios y soporte
                                    técnico.
                                </p>
                                <p class="mb-0 text-blanco">
                                    <i class="bi bi-cash-coin me-1"></i>Desde <strong>$29.990</strong>
                                </p>
                                <a class="btn btn-turquesa mt-3" href="{{route('viewService')}}">Ver
                                    más
                                </a>
                            </div>
                        </article>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <article class="card bg-azul text-light border-light shadow-sm service-card">
                            <img src="../img/servicios/producto.png"
                                 class="card-img-top" alt="Mockup de un sitio institucional"
                                 loading="lazy" decoding="async">
                            <div class="card-body">
                                <h3 class="font-bankgothic fs-4">Sitio institucional</h3>
                                <p class="text-blanco">Páginas informativas (inicio, servicios, nosotros, contacto) y
                                    blog
                                    opcional.</p>
                                <p class="mb-0 text-blanco"><i class="bi bi-cash-coin me-1"></i>Desde
                                    <strong>$149.990</strong></p>
                                <a class="btn btn-turquesa mt-3" href="{{route('viewService')}}">Ver
                                    más
                                </a>
                            </div>
                        </article>
                    </div>


                    <div class="col-md-6 col-lg-4" id="cms">
                        <article class="card bg-azul text-light border-light shadow-sm service-card">
                            <img src="../img/servicios/producto3.png"
                                 class="card-img-top" alt="Panel de administración de un CMS moderno"
                                 loading="lazy" decoding="async">
                            <div class="card-body">
                                <h3 class="font-bankgothic fs-4">Implementación CMS</h3>
                                <p class="text-blanco">Montaje y ajustes de CMS para que edites tu contenido sin
                                    fricción.</p>
                                <p class="mb-0 text-blanco"><i class="bi bi-cash-coin me-1"></i>Desde
                                    <strong>$119.990</strong></p>
                                <a class="btn btn-turquesa mt-3" href="{{route('viewService')}}">Ver
                                    más
                                </a>
                            </div>
                        </article>
                    </div>

                    <div class="col-md-6 col-lg-4" id="form">
                        <article class="card bg-azul text-light border-light shadow-sm service-card">
                            <img src="../img/servicios/formulario.jpg"
                                 class="card-img-top" alt="Formulario web con validaciones"
                                 loading="lazy" decoding="async">
                            <div class="card-body">
                                <h3 class="font-bankgothic fs-4">Formulario web</h3>
                                <p class="text-blanco">Diseño y validación de formularios accesibles con envío
                                    básico.</p>
                                <p class="mb-0 text-blanco"><i class="bi bi-cash-coin me-1"></i>Desde
                                    <strong>$49.990</strong></p>
                                <a class="btn btn-turquesa mt-3" href="{{route('viewService')}}">Ver
                                    más
                                </a>
                            </div>
                        </article>
                    </div>

                    <div class="col-md-6 col-lg-4" id="seo">
                        <article class="card bg-azul text-light border-light shadow-sm service-card">
                            <img src="../img/servicios/seo.jpg"
                                 class="card-img-top" alt="Reportes y métricas de SEO on-page"
                                 loading="lazy" decoding="async">
                            <div class="card-body">
                                <h3 class="font-bankgothic fs-4">SEO on-page</h3>
                                <p class="text-blanco">Etiquetas, estructura, performance y accesibilidad para
                                    posicionar mejor.</p>
                                <p class="mb-0 text-blanco"><i class="bi bi-cash-coin me-1"></i>Desde
                                    <strong>$59.990</strong></p>
                                <a class="btn btn-turquesa mt-3" href="{{route('viewService')}}">Ver
                                    más
                                </a>
                            </div>
                        </article>
                    </div>

                    <div class="col-md-6 col-lg-4" id="mant">
                        <article class="card bg-azul text-light border-light shadow-sm service-card">
                            <img src="../img/servicios/mantenimientoWeb.webp"
                                 class="card-img-top" alt="Mantenimiento mensual de sitios"
                                 loading="lazy" decoding="async">
                            <div class="card-body">
                                <h3 class="font-bankgothic fs-4">Mantenimiento mensual</h3>
                                <p class="text-blanco">Actualizaciones, monitoreo básico y soporte con SLA acordado.</p>
                                <p class="mb-0 text-blanco"><i class="bi bi-cash-coin me-1"></i>Desde
                                    <strong>$39.990</strong></p>
                                <a class="btn btn-turquesa mt-3" href="{{route('viewService')}}">Ver
                                    más
                                </a>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-layout>
