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
  </section>
  @if($user->role === 'user')
    {{--si el usuario es un cliente muestro sus subscripciones--}}
    <section class="container">
      {{-- LISTADO DE SUSCRIPCIONES --}}
      <div class="d-flex justify-content-between align-items-end mb-3">
        <h2 class="fs-3 font-bankgothic fw-bold mb-0">Suscripciones del usuario</h2>
      </div>
      <div class="mb-5 p-3 bg-azul rounded-2">
        <h3 class="fs-4 font-bankgothic fw-bold">Historial de pagos</h3>
        <div class="card border-light border-2 ">
          <div class="table-responsive">
            <table class="table table-striped align-middle mb-0">
              <thead>
              <tr class="table-dark font-bankgothic">
                <th class="text-center rounded-rounded-tl-lg">Fecha</th>
                <th>Servicio</th>
                <th>Plan</th>
                <th>Tipo</th>
                <th>Monto</th>
                <th>Estado</th>
                <th class="text-center rounded-tr-full">Factura</th>
              </tr>
              </thead>
              <tbody id="paymentsBody">
              @forelse($subscriptions as $sub)
                <tr>
                  <td class="text-center">{{ optional($sub->started_at)->format('d/m/Y') }}</td>
                  <td>{{ $sub->service->name }}</td>
                  <td>
                    @if($sub->plan->name == 'Único')
                      <span class="badge bg-turquesa">Pago Único</span>
                    @endif
                    @if($sub->plan->name == 'Pro')
                      <span class="badge bg-azul">Profesional</span>
                    @endif
                    @if($sub->plan->name == 'Empresarial')
                      <span class="badge bg-azul-light">Empresarial</span>
                    @endif
                    @if($sub->plan->name == 'Básico')
                      <span class="badge bg-azul">Básico</span>
                    @endif
                  </td>
                  <td class="text-center">

                    @if($sub->plan->type == 'único')
                      <span class="badge bg-turquesa">Pago único</span>
                    @endif
                    @if($sub->plan->type == 'mensual')
                      <span class="badge bg-azul">Mensual</span>
                    @endif
                    @if($sub->plan->type == 'anual')
                      <span class="badge bg-azul-light">Anual</span>
                    @endif

                  </td>
                  <td>${{ number_format($sub->price, 2, ',', '.') }}</td>
                  <td class="text-center"><span class="badge bg-turquesa">{{ $sub->status }}</span></td>
                  <td class="text-center"><a class="btn btn-sm btn-azul" href="#"><i class="fas fa-download me-1"></i>Descargar</a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center text-secondary py-4">No hay pagos registrados</td>
                </tr>
              @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="row g-4">
        @forelse($subscriptions as $sub)
          <div class="col-md-6 col-lg-4">
            <div class="card bg-azul text-light border-0  h-100">
              <img src="{{ asset('storage/img/services/' . ($sub->service->image ?? 'default.webp')) }}"
                   class="card-img-top" alt="{{ $sub->service->name }}">

              <div class="card-body d-flex flex-column">
                <h2 class="fs-4 text-turquesa font-bankgothic mb-1">
                  {{ $sub->service->name }}
                </h2>
                <p class="text-blanco small mb-3">{{ $sub->service->subtitle ?? '—' }}</p>

                <ul class="list-unstyled  p-0 mb-3">
                  <li><span class="text-turquesa">Plan:</span>
                    <span class="text-blanco small">{{ $sub->plan->name }}</span>
                    ({{ $sub->plan->type }})
                  </li>
                  <li><span class="text-turquesa">Estado:</span>
                    <span class="badge bg-turquesa ms-1 text-uppercase small">{{ $sub->status }}</span>
                  </li>
                  <li><span class="text-turquesa">Inicio:</span>
                    {{ optional($sub->started_at)->format('d/m/Y') ?? '—' }}
                  </li>
                  <li><span class="text-turquesa">Próxima renovación:</span>
                    {{ optional($sub->next_renewal_at)->format('d/m/Y') ?? '—' }}
                  </li>
                  <li><span class="text-turquesa">Precio:</span>
                    <span class="text-light fw-bold small">${{ number_format($sub->price, 2, ',', '.') }}</span>
                  </li>
                </ul>

                @if(!empty($sub->plan->features))
                  <div class="border-top py-4">
                    <h3 class="fs-5 font-bankgothic text-turquesa mb-1">Características del plan:</h3>
                    <ul class="mb-0 p-0 small">
                      @foreach(($sub->plan->features ?? []) as $feature)
                        <li><i class="fa-regular fa-circle-check me-1 text-turquesa"></i>{{ $feature }}</li>
                      @endforeach

                    </ul>
                  </div>
                @endif

                @if(!empty($sub->service->conditions))
                  <div class="border-top mt-2 py-4">
                    <h3 class="fs-5 text-turquesa font-bankgothic mb-0">Condiciones del servicio:</h3>
                    <p class="small text-blanco mb-0">{{ $sub->service->conditions }}</p>
                  </div>
                @endif
              </div>
            </div>

          </div>
        @empty
          <div class="col-12">
            <div class="alert alert-warning border-0">
              Este usuario no tiene suscripciones activas.
            </div>
          </div>
        @endforelse
      </div>
    </section>

    @if(method_exists($subscriptions, 'links'))
      <div class="mt-3">
        {{ $subscriptions->links() }}
      </div>
    @endif
  @endif

@endsection
