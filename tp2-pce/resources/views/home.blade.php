<x-layout>
    <x-slot:title>Pagina Principal</x-slot:title>
    <main class="mt-5">
        <section class="mt-3 py-5 bg-gradient-dark text-light">
            <div class="container">
                <h1 class="font-bankgothic">Servicios web, <span
                        class="text-turquesa">rápidos y sin vueltas</span>.</h1>
                <p class="text-blanco">
                    Sitios, landings y mantenimiento continuo para pymes y emprendedores. Menos humo, más resultados
                    medibles.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a class="btn btn-turquesa" href="{{route('service')}}">Ver servicios </a>
                </div>
            </div>
        </section>

        <section class="py-5">
            <div class="container">
                <header class="mb-4">
                    <h2 class="font-bankgothic fw-bold fs-2">Servicios destacados</h2>
                    <p class="text-gris mb-0">Elegidos por pymes y emprendedores para despegar su presencia online.</p>
                </header>
                <div class="row g-4">
                    <x-service-card
                        image="img/servicios/producto.png"
                        alt="Mockup de un sitio institucional"
                        title="Sitio institucional"
                        description="Páginas informativas (inicio, servicios, nosotros, contacto) y blog opcional."
                        price="$149.990"
                        link-id="{{route('viewService')}}"
                    />
                    <x-service-card
                        image="img/servicios/producto2.png"
                        alt="Landing page enfocada en conversión"
                        title="Landing / Maquetación"
                        description="Una página enfocada en conversión para campañas o lanzamientos."
                        price="$89.990"
                        link-id="{{route('viewService')}}"
                    />
                    <x-service-card
                        image="img/servicios/producto3.png"
                        alt="Panel de administración de un CMS moderno"
                        title="Implementación CMS"
                        description="Montaje y ajustes de CMS para que edites tu contenido sin fricción."
                        price="$119.990"
                        link-id="{{route('viewService')}}"
                    />

                </div>
            </div>
        </section>

        <section class="py-5 bg-azul text-light">
            <div class="container">
                <header class="mb-4">
                    <h2 class="font-bankgothic fw-bold fs-2">Proyectos recientes</h2>
                    <p class="text-blanco mb-0">Mirá algunas de las últimas páginas desarrolladas para nuestros clientes:</p>
                </header>
                <div class="row g-4">
                    <!-- Puedes reemplazar estos con un loop si tienes datos dinámicos -->
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <img src="img/servicios/hosting.png" class="card-img-top" alt="Sitio ejemplo 1">
                            <div class="card-body">
                                <h3 class="h6 font-bankgothic">Ejemplo PymeTech</h3>
                                <p class="text-gris mb-2">Sitio institucional moderno y responsive para tecnológica pyme local.</p>
                                <a href="#" class="btn btn-outline-turquesa btn-sm">Ver sitio</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <img src="img/servicios/hosting.png" class="card-img-top" alt="Sitio ejemplo 1">
                            <div class="card-body">
                                <h3 class="h6 font-bankgothic">Landing ConverMax</h3>
                                <p class="text-gris mb-2">Landing de campaña con formulario de alta conversión.</p>
                                <a href="#" class="btn btn-outline-turquesa btn-sm">Ver sitio</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <img src="img/servicios/hosting.png" class="card-img-top" alt="Sitio ejemplo 1">
                            <div class="card-body">
                                <h3 class="h6 font-bankgothic">Blog MiNegocio</h3>
                                <p class="text-gris mb-2">Implementación de CMS editable para emprendimiento personal.</p>
                                <a href="#" class="btn btn-outline-turquesa btn-sm">Ver sitio</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h2 class="font-bankgothic fw-bold fs-2 mb-2">Construimos presencia digital que <span class="text-turquesa">vende</span>.</h2>
                        <p class="mb-0 ">
                            En Lili-Studio acompañamos a pymes y emprendedores con sitios, landings y mantenimiento continuo. Menos humo, más resultados medibles.
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a class="btn btn-turquesa" href="{{ route('about') }}">
                            Más información
                        </a>
                    </div>
                </div>
            </div>
        </section>


        <section class="py-5 bg-gradient-dark text-light">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-8">
                        <h2 class="font-bankgothic fw-bold fs-2 mb-2">¿Charlamos tu proyecto?</h2>
                        <p class="mb-0 text-blanco">Escribinos y te respondemos a la brevedad con un alcance y tiempos
                            reales.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a class="btn btn-turquesa" href="{{ route('contact') }}">
                            Contacto
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-layout>
