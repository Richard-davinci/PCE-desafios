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
    <div class="mb-5 p-3 bg-azul rounded-2">
      <h2 class="fs-3 font-bankgothic fw-bold">Historial de pagos</h2>
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
              @if($sub->plan->name !== 'Único')
                <div class="mt-auto">
                  <a href="#" class="btn btn-turquesa w-100 mt-3">Cambiar plan</a>
                  <a href="#" class="btn btn-turquesa w-100 mt-3">Cancelar subscripción</a>
                </div>
              @endif
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
