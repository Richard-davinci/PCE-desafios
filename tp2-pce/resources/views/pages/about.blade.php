@extends('layouts.app')

@section('title', 'Nosotros')

@section('content')

  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container">
      <div class="align-items-center g-4">
        <h1 class="font-bankgothic fw-bold mb-3">Construimos presencia digital que <span
            class="text-turquesa">vende</span>.
        </h1>
        <p class="text-blanco">En Lili-Studio acompañamos a pymes y emprendedores con
          sitios, landings y mantenimiento continuo. Menos humo, más resultados medibles.</p>
      </div>

    </div>
  </section>
  <section class="container">
    <x-breadcrumb :items="[['label' => 'Inicio',   'route' => 'pages.index'],  ['label' => 'Nosotros']]"
                  separator="›"/>
  </section>


  <section class="py-4">
    <div class="container">
      <div class="mb-4">
        <h2 class="fs-2 font-bankgothic fw-bold">Nuestros valores</h2>
        <p class="text-gris mb-0">Lo que sostiene cada proyecto que entregamos.</p>
      </div>
      <div class="row g-4 text-light">
        <div class="col-md-4">
          <div class="p-4 rounded border-0 bg-azul">

            <h3 class="font-bankgothic fs-3"><i class="bi bi-heart-pulse text-turquesa fs-3 me-2"></i>Empatía</h3>
            <p class="text-blanco">Escuchamos el negocio y sus tiempos. La tecnología se
              adapta a vos, no al revés.</p>
          </div>
        </div>
        <div class="col-md-4 ">
          <div class="p-4 rounded border-0 bg-azul">

            <h3 class="font-bankgothic fs-3"><i class="bi bi-graph-up-arrow text-turquesa fs-3 me-2"></i> Resultados
            </h3>
            <p class="text-blanco">Métricas simples: velocidad, conversión y claridad. Todo
              con foco en ROI.</p>
          </div>
        </div>
        <div class="col-md-4 ">
          <div class="p-4 rounded border-0 bg-azul">

            <h3 class="font-bankgothic fs-3"><i class="bi bi-shield-check text-turquesa fs-3 me-2"></i>Calidad</h3>
            <p class="text-blanco">Buenas prácticas, accesibilidad y performance como
              estándar, no opcional.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5 bg-azul text-light">
    <div class="container">
      <div class="mb-4">
        <h2 class="fs-2 font-bankgothic fw-bold">Equipo</h2>
        <p>Chico pero cumplidor. Nos organizamos para entregar en tiempo y forma.</p>
      </div>
      <div class="row g-4">
        <div class="col-md-4">
          <article class="card bg-surface">
            <div class="card-body">
              <div class="d-flex align-items-center gap-3">
                <div class="icono rounded-circle bg-azul d-flex align-items-center justify-content-center">
                  <i class="bi bi-person-badge fs-4 text-turquesa"></i>
                </div>
                <div>
                  <h3 class="h6 mb-0">Ricardo Garcia</h3>
                  <small class="text-gris">Desarrollador Full-Stack</small>
                </div>
              </div>
              <p class=" text-gris mt-3 mb-0">PHP/MySQL, Vue/Vuetify y despliegue. Enfoque
                pragmático y entregas a tiempo.</p>
            </div>
          </article>
        </div>
        <div class="col-md-4">
          <article class="card bg-surface border-0 h-100 shadow-sm">
            <div class="card-body">
              <div class="d-flex align-items-center gap-3">
                <div class="icono rounded-circle bg-azul d-flex align-items-center justify-content-center">
                  <i class="bi bi-brush fs-4 text-turquesa"></i>
                </div>
                <div>
                  <h3 class="h6 mb-0">Diseño</h3>
                  <small class="text-gris">UI/UX • Identidad</small>
                </div>
              </div>
              <p class="text-gris mt-3 mb-0">Sistemas de diseño, escalabilidad visual y
                microinteracciones que suman.</p>
            </div>
          </article>
        </div>
        <div class="col-md-4">
          <article class="card bg-surface border-0 h-100 shadow-sm">
            <div class="card-body">
              <div class="d-flex align-items-center gap-3">
                <div class="icono rounded-circle bg-azul d-flex align-items-center justify-content-center">
                  <i class="bi bi-gear-wide-connected fs-4 text-turquesa"></i>
                </div>
                <div>
                  <h3 class="h6 mb-0">Soporte</h3>
                  <small class="text-gris">Mantenimiento • SEO</small>
                </div>
              </div>
              <p class="text-gris mt-3 mb-0">Monitoreo, actualizaciones y mejoras periódicas
                para que el sitio rinda.</p>
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5">
    <div class="container">
      <header class="mb-4">
        <h2 class="fs-2 font-bankgothic fw-bold">Tecnologías & proceso</h2>
        <p class="text-gris">Stack moderno y flujo simple para avanzar sin trabas.</p>
      </header>
      <div class="row g-4 text-light">

        <div class="col-md-6">
          <div class="procesos-container">
            <h3 class="fs-3">Procesos</h3>
            <ul>
              <li><i class="bi bi-check fs-4 text-turquesa me-2"></i>Relevamiento inicial y objetivos del proyecto
              </li>
              <li><i class="bi bi-check fs-4 text-turquesa me-2"></i>Propuesta de diseño y wireframes</li>
              <li><i class="bi bi-check fs-4 text-turquesa me-2"></i>Desarrollo frontend y backend</li>
              <li><i class="bi bi-check fs-4 text-turquesa me-2"></i>Testing y optimización</li>
              <li><i class="bi bi-check fs-4 text-turquesa me-2"></i>Despliegue y configuración</li>
              <li><i class="bi bi-check fs-4 text-turquesa me-2"></i>Soporte post-implementación</li>
            </ul>
          </div>
        </div>
        <div class="col-md-6">
          <div class="p-4 bg-azul rounded shadow-sm tecnologias-container">
            <h3 class="fs-3 font-bankgothic mb-3">Tecnologías</h3>
            <div class="d-flex flex-wrap gap-3 mt-2">
                  <span class="badge bg-turquesa" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Framework front-end">
                    <i class="bi bi-bootstrap-fill me-1"></i>Bootstrap 5
                  </span>
              <span class="badge bg-turquesa" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Lenguaje para estructuras y estilos">
                    <i class="bi bi-code-slash me-1"></i>HTML/CSS
                  </span>
              <span class="badge bg-turquesa" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Lenguaje de programación para la web">
                    <i class="bi bi-braces me-1"></i>JavaScript
                  </span>
              <span class="badge bg-turquesa" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Framework front-end progresivo">
                    <i class="bi bi-code-square me-1"></i>Vue 3
                  </span>
              <span class="badge bg-turquesa" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Librería UI de componentes para Vue">
                    <i class="bi bi-grid-3x3-gap me-1"></i>Vuetify 3
                  </span>
              <span class="badge bg-turquesa" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Lenguaje de desarrollo back-end">
                    <i class="bi bi-filetype-php me-1"></i>PHP
                  </span>
              <span class="badge bg-turquesa" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Framework PHP para aplicaciones web">
                    <i class="bi bi-infinity me-1"></i>Laravel 12
                  </span>
              <span class="badge bg-turquesa" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Optimización de velocidad y carga">
                    <i class="bi bi-speedometer2 me-1"></i>Performance
                  </span>
              <span class="badge bg-turquesa" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Prácticas inclusivas y usabilidad">
                    <i class="bi bi-universal-access me-1"></i>Accesibilidad
                  </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5 text-light bg-gradient-dark">
    <div class="container">
      <div
        class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
        <div>
          <h2 class="fs-3 font-bankgothic fw-bold mb-1">¿Listo para arrancar?</h2>
          <p class="text-blanco">Elegí un plan o escribinos y coordinamos el inicio.</p>
        </div>
        <div class="d-flex gap-2">
          <a class="btn btn-turquesa fs-6" href="{{route('pages.services')}}">Ver servicios</a>
          <a class="btn btn-outline-turquesa fs-6" href="{{route('pages.contact')}}">Contacto</a>
        </div>
      </div>
    </div>
  </section>
@endsection
