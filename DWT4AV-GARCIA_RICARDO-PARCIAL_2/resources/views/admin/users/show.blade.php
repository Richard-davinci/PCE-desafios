@extends('layouts.app')
@section('title', 'Detalle de usuario')

@section('content')
  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container">
      <div class="d-flex flex-wrap justify-content-between align-items-end mb-4">
        <div>
          <h1 class="fs-2 font-bankgothic fw-bold mb-1 text-turquesa">
            {{ $user->name ?? 'Usuario' }}
          </h1>
          <p class="text-balnco mb-0">
            <i class="fa-regular fa-envelope me-1"></i> {{ $user->email ?? '—' }}
            @if(!empty($user->role))
              <span class="badge bg-info text-dark ms-2 text-uppercase">{{ $user->role }}</span>
            @endif
          </p>
        </div>
        <div class="d-flex gap-2">
          <a href="{{ route('admin.users.index') }}" class="btn btn-outline-turquesa">
            <i class="fa-solid fa-chevron-left me-2"></i> Volver
          </a>
          <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-turquesa">
            <i class="fa-regular fa-pen-to-square me-2"></i> Editar
          </a>
        </div>
      </div>
    </div>
  </section>
  <section class="container py-5">
    {{-- DATOS --}}

    <div class="card bg-azul text-light border-0 shadow-sm h-100">
      <div class="card-body">
        <h2 class="fs-3 text-turquesa mb-3 font-bankgothic">Información del usuario</h2>
        <div class="row g-3">
          <div class="col-md-6">
            <ul class="list-unstyled small mb-0">

              <li class="mb-2">
                <span class="text-turquesa">Nombre:</span>
                <span class="text-blanco ms-1">{{ $user->name }}</span>
              </li>

              <li class="mb-2">
                <span class="text-turquesa">Email:</span>
                <span class="text-blanco ms-1">{{ $user->email }}</span>
              </li>

              <li class="mb-2">
                <span class="text-turquesa">Rol:</span>
                <span class="text-blanco ms-1 text-uppercase">{{ $user->role }}</span>
              </li>

              <li class="mb-2">
                <span class="text-turquesa">Teléfono:</span>
                <span class="text-blanco ms-1">{{ $user->phone ?: 'No especificado' }}</span>
              </li>

              <li class="mb-2">
                <span class="text-turquesa">Ciudad:</span>
                <span class="text-blanco ms-1">{{ $user->city ?: 'No especificada' }}</span>
              </li>

            </ul>
          </div>

          <div class="col-md-6">
            <ul class="list-unstyled small mb-0">

              <li class="mb-2">
                <span class="text-turquesa">Foto de perfil:</span>
                <span class="text-blanco ms-1">{{ $user->profile_photo ? 'Cargada' : 'Default' }}</span>
              </li>

              <li class="mb-2">
                <span class="text-turquesa">Cambio de contraseña:</span>
                @if(!empty($user->must_change_password) && $user->must_change_password)
                  <span class="badge bg-warning text-dark ms-1">Pendiente</span>
                @else
                  <span class="badge bg-turquesa ms-1">Actualizada</span>
                @endif
              </li>

              <li class="mb-2">
                <span class="text-turquesa">Alta:</span>
                <span class="text-blanco ms-1">{{ $user->created_at->format('d/m/Y') }}</span>
              </li>

              <li class="mb-2">
                <span class="text-turquesa">Última actualización:</span>
                <span class="text-blanco ms-1">{{ $user->updated_at->diffForHumans() }}</span>
              </li>

              <li class="mb-2">
                <span class="text-turquesa">Suscripciones:</span>
                <span class="badge bg-turquesa ms-1 fs-6">{{ $subscriptions->total() ?? 0 }}</span>
              </li>

            </ul>
          </div>
        </div>
      </div>

    </div>
    @if($user->role === 'user')

      {{-- LISTADO DE SUSCRIPCIONES --}}
      <div class="d-flex justify-content-between align-items-end mt-5 mb-3">
        <h2 class="fs-3 font-bankgothic fw-bold mb-0">Suscripciones del usuario</h2>
      </div>

      <div class="row g-4">
        @forelse($subscriptions as $sub)
          <div class="col-md-6 col-lg-4">
            <div class="card bg-azul text-light border-0 shadow-sm h-100">

              {{-- Imagen del servicio --}}
              <img src="{{ asset('storage/img/services/' . ($sub->service->image ?? 'default.webp')) }}"
                   class="card-img-top" alt="{{ $sub->service->name ?? 'Servicio' }}">

              <div class="card-body d-flex flex-column">
                <h3 class="fs-4 text-turquesa font-bankgothic mb-1">
                  {{ $sub->service->name ?? 'Servicio' }}
                </h3>
                <p class="text-balnco mb-2">{{ $sub->service->subtitle ?? '—' }}</p>

                <ul class="list-unstyled small mb-3">
                  <li><span class="text-turquesa">Plan:</span> <span
                      class="text-blanco ms-1">{{ $sub->plan->name ?? '-' }}</span>
                    <span class="ms-2 text-capitalize">({{ $sub->plan->type ?? '-' }})</span></li>
                  <li><span class="text-turquesa">Estado:</span>
                    <span class="badge bg-success ms-1 text-uppercase">{{ $sub->status ?? 'activa' }}</span></li>
                  <li><span class="text-turquesa">Inicio:</span>
                    <span class="text-blanco ms-1">{{ optional($sub->started_at)->format('d/m/Y') ?? '—' }}</span></li>
                  <li><span class="text-turquesa">Próxima renovación:</span>
                    <span class="text-blanco ms-1">{{ optional($sub->next_renewal_at)->format('d/m/Y') ?? '—' }}</span>
                  </li>
                  <li><span class="text-turquesa">Precio:</span>
                    <span
                      class="text-turquesa fw-bold ms-1">${{ number_format($sub->price ?? ($sub->plan->price ?? 0), 2, ',', '.') }}</span>
                  </li>
                </ul>

                {{-- Características del plan --}}
                @php
                  $features = $sub->plan->features ?? [];
                  if (is_string($features)) {
                    $decoded = json_decode($features, true);
                    $features = json_last_error() === JSON_ERROR_NONE ? $decoded : explode(',', $features);
                  }
                  if (!is_array($features)) $features = [];
                @endphp

                @if(!empty($features))
                  <div class="border-top pt-2">
                    <p class="small text-turquesa mb-1">Características del plan:</p>
                    <ul class="mb-0 small">
                      @foreach($features as $feature)
                        <li><i class="fa-regular fa-circle-check me-1 text-turquesa"></i>{{ trim($feature) }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif

                {{-- Condiciones --}}
                @if(!empty($sub->service->conditions))
                  <div class="border-top mt-2 pt-2">
                    <p class="small text-turquesa mb-0">Condiciones:</p>
                    <p class="small text-blanco mb-0">{{ $sub->service->conditions }}</p>
                  </div>
                @endif
              </div>
            </div>
          </div>
        @empty
          <div class="col-12">
            <div class="alert alert-warning border-0">Este usuario no posee suscripciones.</div>
          </div>
        @endforelse
      </div>

      @if(method_exists($subscriptions, 'links'))
        <div class="mt-3">
          {{ $subscriptions->links() }}
        </div>
      @endif
    @endif
  </section>
@endsection
