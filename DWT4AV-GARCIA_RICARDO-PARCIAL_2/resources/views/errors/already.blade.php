@extends('layouts.auth')

@section('title', 'Suscripción existente')

@section('content')
  <section class="error-wrapper bg-gradient-dark text-light">

    <div class="error-card">
      <div class="mb-3">
        <i class="fa-solid fa-triangle-exclamation error-icon"></i>
      </div>

      <h1 class="fs-1 text-turquesa font-bankgothic mb-3">
        Suscripción activa
      </h1>

      <p class="fs-6 text-blanco mb-4">
        Ya tenés una suscripción activa para el servicio:
        <span class="text-turquesa fw-bold">
          {{ $subscription->service->name }}
        </span>.
        <br>
        No podés adquirirlo nuevamente mientras esta suscripción siga activa.
      </p>

      {{-- Información básica de la suscripción --}}
      <div class="text-start mx-auto mb-4" style="max-width: 360px;">
        <p class="mb-2">
          <span class="text-turquesa">Plan actual:</span>
          <span class="text-blanco">{{ $subscription->plan->name ?? '—' }}</span>
        </p>

        <p class="mb-2">
          <span class="text-turquesa">Precio:</span>
          <span class="text-blanco">${{ $subscription->plan->price ?? 0 }}</span>
        </p>

        <p class="mb-2">
          <span class="text-turquesa">Estado:</span>
          <span class="badge bg-turquesa text-dark">
            {{ $subscription->status }}
          </span>
        </p>

        @if($subscription->renews_at)
          <p class="mb-2">
            <span class="text-turquesa">Renovación:</span>
            <span class="text-blanco">{{ $subscription->renews_at }}</span>
          </p>
        @endif
      </div>

      {{-- Botones --}}
      <div class="d-flex flex-column gap-3 mx-auto" style="max-width: 280px;">
        <a href="{{ route('user.subscriptions') }}" class="btn btn-turquesa">
          Ver mis suscripciones
        </a>

        <a href="{{ route('pages.viewService', $subscription->service_id) }}"
           class="btn btn-outline-light">
          Volver al servicio
        </a>
      </div>

    </div>

  </section>
@endsection
