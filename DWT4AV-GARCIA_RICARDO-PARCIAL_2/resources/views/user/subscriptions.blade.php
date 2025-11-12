@extends('layouts.app')
@section('title', 'Mis suscripciones')

@section('content')
  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container">
      <div class="d-flex flex-wrap justify-content-between align-items-end mb-3">
        <div>
          <h1 class="fs-2 font-bankgothic fw-bold mb-1">Mis suscripciones</h1>
          <p class="text-blanco mb-0">Administrá tus planes y accesos.</p>
        </div>
      </div>
    </div>
  </section>
  <section class="container py-5">
    <div class="row g-4">
      @forelse($subscriptions as $sub)
        <div class="col-md-6 col-lg-4">
          <div class="card bg-azul text-light border-0 shadow-sm h-100">
            <img src="{{ asset('storage/img/services/' . ($sub->service->image ?? 'default.webp')) }}"
                 class="card-img-top" alt="{{ $sub->service->name }}">

            <div class="card-body d-flex flex-column">
              <h2 class="h6 text-turquesa font-bankgothic mb-1">
                {{ $sub->service->name }}
              </h2>
              <p class="text-blanco mb-3">{{ $sub->service->subtitle ?? '—' }}</p>

              <ul class="list-unstyled small p-0 mb-3">
                <li><span class="text-turquesa">Plan:</span>
                  <span class="text-blanco">{{ $sub->plan->name }}</span>
                  ({{ $sub->plan->type }})
                </li>
                <li><span class="text-turquesa">Estado:</span>
                  <span class="badge bg-success ms-1 text-uppercase">{{ $sub->status }}</span>
                </li>
                <li><span class="text-turquesa">Inicio:</span>
                  {{ optional($sub->started_at)->format('d/m/Y') ?? '—' }}
                </li>
                <li><span class="text-turquesa">Próxima renovación:</span>
                  {{ optional($sub->next_renewal_at)->format('d/m/Y') ?? '—' }}
                </li>
                <li><span class="text-turquesa">Precio:</span>
                  <span class="text-light fw-bold">${{ number_format($sub->price, 2, ',', '.') }}</span>
                </li>
              </ul>

              @if(!empty($sub->plan->features))
                <div class="border-top pt-2">
                  <p class="small text-turquesa mb-1">Características del plan:</p>
                  <ul class="mb-0 p-0 small">
                    @foreach(($sub->plan->features ?? []) as $feature)
                      <li><i class="fa-regular fa-circle-check me-1 text-turquesa"></i>{{ $feature }}</li>
                    @endforeach

                  </ul>
                </div>
              @endif

              @if(!empty($sub->service->conditions))
                <div class="border-top mt-2 pt-2">
                  <p class="small text-turquesa mb-0">Condiciones:</p>
                  <p class="small text-blanco mb-0">{{ $sub->service->conditions }}</p>
                </div>
              @endif
              <div class="mt-auto">
                <a href="#" class="btn btn-turquesa w-100 mt-3">Cambiar plan</a>
              </div>
            </div>
          </div>

        </div>
      @empty
        <div class="col-12">
          <div class="alert alert-warning border-0">
            Aún no tenés suscripciones activas.
          </div>
        </div>
      @endforelse
    </div>

    @if(method_exists($subscriptions, 'links'))
      <div class="mt-3">
        {{ $subscriptions->links() }}
      </div>
    @endif
  </section>
@endsection
