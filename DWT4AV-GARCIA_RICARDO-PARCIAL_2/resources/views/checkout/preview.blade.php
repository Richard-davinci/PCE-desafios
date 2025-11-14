@extends('layouts.app')
@section('title', 'Pre-visualización de suscripción')

@section('content')
  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container">
      <h1 class="fs-2 font-bankgothic fw-bold mb-1">Confirmá tu suscripción</h1>
      <p class="text-blanco mb-4">Revisá los datos antes de confirmar.</p>
    </div>
  </section>
  <section class="container py-5">
    <div class="row g-4">
      <div class="col-lg-7">
        <div class="card bg-azul text-light border-0 shadow-sm h-100">
          <div class="card-body">
            <h2 class="h3 font-bankgothic text-turquesa mb-3">
              {{ $service->name ?? 'Servicio' }} — {{ $plan->name ?? 'Plan' }}
            </h2>

            <ul class="list-unstyled mb-3">
              <li class="mb-2"><i class="fa-regular fa-note-sticky me-2"></i>
                <span class="text-turquesa">Descripción:</span>
                <span class="text-blanco small">{{ $service->subtitle ?? '-' }}</span>
              </li>
              <li class="mb-2"><i class="fa-regular fa-calendar me-2"></i>
                <span class="text-turquesa">Período:</span>
                <span class="text-blanco small text-capitalize">{{ $plan->type ?? 'único' }}</span>
              </li>
              <li class="mb-2"><i class="fa-regular fa-money-bill-1 me-2"></i>
                <span class="text-turquesa">Precio:</span>
                <span class="text-blanco small fw-semibold">
                  U$D{{ number_format($plan->price ?? 0, 2, ',', '.') }}
                </span>
              </li>
            </ul>
            @if(!empty($service->conditions))
              <div class="border-top py-3">
                <h3 class="fs-4 font-bankgothic text-turquesa mt-2 mb-1">Condiciones del servicio</h3>
                <ul class="list-unstyled mb-0">
                  @foreach(array_filter(explode(',', $service->conditions)) as $cond)
                    <li class="small mb-1">
                      <i class="fa-solid fa-circle-check text-turquesa me-2"></i>
                      {{ trim($cond) }}
                    </li>
                  @endforeach
                </ul>
              </div>
            @endif
            @if(!empty($plan->features ?? null))
              <div class="border-top py-3">
                <h3 class="fs-4 font-bankgothic text-turquesa mt-2 mb-1">Características del servicio</h3>

                <ul class="small ps-0 mb-3">
                  @foreach($plan->features as $f)
                    <li><i class="fa-solid fa-circle-check text-turquesa me-2"></i>{{ trim($f) }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

          </div>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="card bg-azul text-light border-0 shadow-sm ">
          <div class="card-body d-flex flex-column">
            <h3 class="h6 text-turquesa mb-3">Resumen</h3>

            <div class="d-flex justify-content-between mb-2">
              <span>{{ $plan->name ?? 'Plan' }}</span>
              <span>U$D{{ number_format($plan->price ?? 0, 2, ',', '.') }}</span>
            </div>

            <div class="d-flex justify-content-between border-top pt-2 mt-2">
              <span class="fw-semibold">Total</span>
              <span class="fw-bold text-turquesa">U$D{{ number_format($plan->price ?? 0, 2, ',', '.') }}</span>
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
                  Confirmar Pago
                </button>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
