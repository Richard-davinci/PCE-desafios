@extends('layouts.app')
@section('title', '¡Gracias por suscribirte!')

@section('content')
  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container" style="max-width: 900px">
      <div class="text-center mb-4">
        <i class="fa-regular fa-circle-check display-3 text-turquesa mb-3"></i>
        <h1 class="fs-2 font-bankgothic fw-bold mb-2">¡Gracias por suscribirte!</h1>
        <p class="text-blanco mb-0">
          Tu suscripción ya quedó registrada. Podés ver el detalle desde <strong>Mis suscripciones</strong>.
        </p>
      </div>

      <div class="row g-4">
        <div class="col-lg-8 mx-auto">
          <div class="card bg-azul text-light border-0 shadow-sm">
            <div class="card-body">
              <h2 class="h6 text-turquesa mb-3">Resumen</h2>
              <ul class="list-unstyled mb-0">
                <li class="mb-2">
                  <span class="text-turquesa me-2">Servicio:</span>
                  <span class="text-blanco">{{ $service->name ?? '—' }}</span>
                </li>
                <li class="mb-2">
                  <span class="text-turquesa me-2">Plan:</span>
                  <span class="text-blanco">{{ $plan->name ?? '—' }}</span>
                </li>
                <li class="mb-2">
                  <span class="text-turquesa me-2">Período:</span>
                  <span class="text-blanco text-capitalize">{{ $plan->type ?? '—' }}</span>
                </li>
                <li class="mb-1">
                  <span class="text-turquesa me-2">Precio:</span>
                  <span class="text-turquesa fw-bold">${{ number_format($plan->price ?? 0, 2, ',', '.') }}</span>
                </li>
              </ul>
            </div>
          </div>

          <div class="d-flex flex-wrap gap-2 justify-content-center mt-4">
            <a class="btn btn-turquesa" href="{{ route('user.subscriptions') }}">
              <i class="fa-regular fa-rectangle-list me-2"></i> Mis suscripciones
            </a>
            <a class="btn btn-outline-turquesa" href="{{ route('pages.services') }}">
              Seguir explorando servicios
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
