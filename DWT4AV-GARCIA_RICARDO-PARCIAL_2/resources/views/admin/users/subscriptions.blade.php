@extends('layouts.app')
@section('title', 'Suscripciones de usuario')

@section('content')
  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container">
      <div class="d-flex flex-wrap justify-content-between align-items-end mb-3">
        <div>
          <h1 class="fs-2 font-bankgothic fw-bold mb-1">
            Suscripciones — {{ $user->name ?? 'Usuario' }}
          </h1>
          <p class="text-secondary mb-0">
            Email: <span class="text-blanco">{{ $user->email ?? '-' }}</span>
          </p>
        </div>
        <div>
          <a href="{{ route('admin.users.index') }}" class="btn btn-outline-light">
            <i class="fa-solid fa-chevron-left me-2"></i> Volver a usuarios
          </a>
        </div>
      </div>

      <div class="row g-4">
        @forelse($subscriptions as $sub)
          <div class="col-md-6 col-lg-4">
            <div class="card bg-azul text-light border-0 shadow-sm h-100">
              <div class="card-body d-flex flex-column">
                <h2 class="h6 text-turquesa font-bankgothic mb-1">
                  {{ $sub->service->name ?? 'Servicio' }}
                </h2>
                <p class="text-secondary mb-2">
                  Plan: <span class="text-blanco">{{ $sub->plan->name ?? '-' }}</span>
                  <span class="ms-2 small text-capitalize">({{ $sub->plan->type ?? '-' }})</span>
                </p>

                <ul class="list-unstyled small mb-3">
                  <li class="mb-1">
                    <span class="text-secondary">Estado:</span>
                    <span class="badge bg-success ms-1 text-uppercase">{{ $sub->status ?? 'activa' }}</span>
                  </li>
                  <li class="mb-1">
                    <span class="text-secondary">Inicio:</span>
                    <span class="text-blanco">{{ optional($sub->started_at)->format('d/m/Y') ?? '—' }}</span>
                  </li>
                  <li class="mb-1">
                    <span class="text-secondary">Próx. renovación:</span>
                    <span class="text-blanco">{{ optional($sub->next_renewal_at)->format('d/m/Y') ?? '—' }}</span>
                  </li>
                </ul>

                <div class="mt-auto d-flex justify-content-between align-items-center">
                <span class="fw-bold text-turquesa">
                  ${{ number_format($sub->price ?? ($sub->plan->price ?? 0), 2, ',', '.') }}
                </span>
                  <a class="btn btn-outline-light btn-sm" href="{{ route('pages.viewService', $sub->service ?? 0) }}">
                    Ver servicio
                  </a>
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12">
            <div class="alert alert-warning border-0">
              Este usuario no posee suscripciones.
            </div>
          </div>
        @endforelse
      </div>

      @if(method_exists($subscriptions, 'links'))
        <div class="mt-3">
          {{ $subscriptions->links() }}
        </div>
      @endif
    </div>
  </section>
@endsection
