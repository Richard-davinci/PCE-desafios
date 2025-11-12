@extends('layouts.app')
@section('title', 'Pre-visualización de suscripción')

@section('content')
  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container" style="max-width: 900px">
      <h1 class="fs-2 font-bankgothic fw-bold mb-1">Confirmá tu suscripción</h1>
      <p class="text-blanco mb-4">Revisá los datos antes de confirmar.</p>

      <div class="row g-4">
        <div class="col-lg-7">
          <div class="card bg-azul text-light border-0 shadow-sm h-100">
            <div class="card-body">
              <h2 class="h5 font-bankgothic text-turquesa mb-3">
                {{ $service->name ?? 'Servicio' }} — {{ $plan->name ?? 'Plan' }}
              </h2>

              <ul class="list-unstyled mb-3">
                <li class="mb-2"><i class="fa-regular fa-note-sticky me-2"></i>
                  <span class="text-turquesa">Descripción:</span>
                  <span class="text-blanco">{{ $service->subtitle ?? '-' }}</span>
                </li>
                <li class="mb-2"><i class="fa-regular fa-calendar me-2"></i>
                  <span class="text-turquesa">Período:</span>
                  <span class="text-blanco text-capitalize">{{ $plan->type ?? 'único' }}</span>
                </li>
                <li class="mb-2"><i class="fa-regular fa-money-bill-1 me-2"></i>
                  <span class="text-turquesa">Precio:</span>
                  <span class="text-blanco fw-semibold">
                  ${{ number_format($plan->price ?? 0, 2, ',', '.') }}
                </span>
                </li>
              </ul>

              @if(!empty($service->conditions))
                <div class="border-top pt-3">
                  <p class="small mb-0 text-turquesa">Condiciones del servicio</p>
                  <p class="mb-0 text-blanco">{{ $service->conditions }}</p>
                </div>
              @endif
            </div>
          </div>
        </div>

        <div class="col-lg-5">
          <div class="card bg-azul text-light border-0 shadow-sm h-100">
            <div class="card-body d-flex flex-column">
              <h3 class="h6 text-turquesa mb-3">Resumen</h3>

              <div class="d-flex justify-content-between mb-2">
                <span>{{ $plan->name ?? 'Plan' }}</span>
                <span>${{ number_format($plan->price ?? 0, 2, ',', '.') }}</span>
              </div>

              <div class="d-flex justify-content-between border-top pt-2 mt-2">
                <span class="fw-semibold">Total</span>
                <span class="fw-bold text-turquesa">${{ number_format($plan->price ?? 0, 2, ',', '.') }}</span>
              </div>

              <p class="small text-turquesa mt-3">
                Al confirmar, habilitás tu suscripción para este servicio.
              </p>

              <div class="mt-auto d-flex gap-2">
                <form method="POST" action="{{ route('checkout.confirm') }}" class="mt-auto w-100 d-flex gap-2">
                  @csrf
                  {{-- Opcional: reenvío explícito (además de lo que guardaste en sesión) --}}
                  <input type="hidden" name="service_id" value="{{ $service->id }}">
                  <input type="hidden" name="plan_id" value="{{ $plan->id }}">

                  <a href="{{ route('pages.viewService', $service) }}" class="btn btn-outline-turquesa w-100">
                    Cancelar
                  </a>
                  <button type="submit" class="btn btn-turquesa w-100">
                    Confirmar
                  </button>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
