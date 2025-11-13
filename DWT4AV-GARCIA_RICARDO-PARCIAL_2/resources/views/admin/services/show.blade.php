@extends('layouts.app')

@section('title', $service->name . ' - Detalle del servicio')

@section('content')

  @php

    // Plan único
    $uniquePlan = $service->plans->firstWhere('type', 'único');

    // Planes mensuales/anuales agrupados por nombre
    $monthlyPlans = $service->plans
        ->where('type', 'mensual')
        ->sortBy('price')
        ->keyBy('name'); // Básico, Pro, Empresarial

    $annualPlans = $service->plans
        ->where('type', 'anual')
        ->sortBy('price')
        ->keyBy('name');

    $hasMonthly = $monthlyPlans->isNotEmpty();
  @endphp

  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container">
      <h1 class="fs-1 font-bankgothic fw-bold mb-1">{{ $service->name }}</h1>
      <p class="text-balnco mb-2">{{ $service->subtitle }}</p>

      <div class="d-flex flex-wrap align-items-center gap-3">
        @if($service->category)
          <span class="badge bg-turquesa text-dark">
            <i class="bi bi-bookmark"></i> {{ $service->category->name }}
          </span>
        @endif

        <span class="badge
            @if($service->status === 'Activo') bg-success
            @elseif($service->status === 'Pausado') bg-warning text-dark
            @else bg-secondary
            @endif">
          {{ $service->status ?? 'Sin estado' }}
        </span>

      </div>
      <div class="d-flex gap-2">
        <a href="{{ route('admin.services.index') }}" class="btn btn-turquesa ms-auto">
          <i class="fa-solid fa-chevron-left me-2"></i> Volver
        </a>
        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-turquesa">
          <i class="fa-regular fa-pen-to-square me-2"></i> Editar
        </a>
      </div>
    </div>
  </section>

  <section class="container py-5">
    <div class="row g-4 align-items-start">
      <div class="col-lg-4">
        <div class="card bg-azul border-light shadow-sm mb-3">
          <div class="card-body">
            <img src="{{ asset('storage/img/services/' . ($service->image ?? 'default.webp')) }}"
                 alt="{{ $service->name ?? 'sin imagen' }}"
                 class="img-fluid img-thumb mb-3 rounded-3">

            <h2 class="fs-5 font-bankgothic text-turquesa mb-2">Descripción</h2>
            <p class=" mb-2">
              {!! nl2br(e($service->description)) !!}
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-8">

        <div class="card bg-azul border-light shadow-sm mb-3">
          <div class="card-body">
            @if($service->conditions)
              <h2 class="fs-6 font-bankgothic text-turquesa mt-2 mb-1">Condiciones</h2>
              <ul class="list-unstyled mb-0">
                @foreach(array_filter(explode(',', $service->conditions)) as $cond)
                  <li>
                    <i class="fa-solid fa-circle-check text-turquesa me-2"></i>
                    {{ trim($cond) }}
                  </li>
                @endforeach
              </ul>
            @endif
          </div>
        </div>


        @if(!$uniquePlan && !$hasMonthly)
          <div class="card bg-azul border-light shadow-sm">
            <div class="card-body">
              <h2 class="fs-4 font-bankgothic text-turquesa mb-2">Planes</h2>
              <p class="text-balnco mb-0">
                Este servicio todavía no tiene planes configurados.
              </p>
            </div>
          </div>
        @endif

        {{-- PLAN ÚNICO --}}
        @if($uniquePlan)
          <div class="card bg-azul border-light shadow-sm mb-4">
            <div class="card-body">
              <h2 class="fs-3 font-bankgothic text-turquesa mb-2">Pago único</h2>
              <p class="fs-3 fw-bold mb-1">
                U$D {{ number_format($uniquePlan->price, 2, ',', '.') }}
              </p>
              <p class="small mb-2">
                Pago único. Ideal si querés resolver todo en una sola inversión.
              </p>

              @if(!empty($uniquePlan->features))
                <ul class="small ps-3 mb-3">
                  @foreach($uniquePlan->features as $f)
                    <li><i class="fa-solid fa-circle-check text-turquesa me-2"></i>{{ trim($f) }}
                    </li>
                  @endforeach
                </ul>
              @endif
            </div>
          </div>
        @endif

        {{-- PLANES MENSUALES--}}
        @if($hasMonthly)
          <div class="card bg-azul text-light border-light shadow-sm">
            <div class="card-body">

              <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 mb-2">
                <h2 class="fs-4 font-bankgothic text-turquesa mb-0">
                  Planes
                </h2>

                <ul class="nav tabs-underline justify-content-center mb-0" id="planTabs" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active font-bankgothic fs-6"
                            id="mensual-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#mensual"
                            type="button"
                            role="tab"
                            aria-controls="mensual"
                            aria-selected="true">
                      Mensual
                    </button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link font-bankgothic fs-6"
                            id="anual-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#anual"
                            type="button"
                            role="tab"
                            aria-controls="anual"
                            aria-selected="false">
                      Anual
                    </button>
                  </li>
                </ul>
              </div>

              <div class="tab-content mt-2" id="planTabsContent">
                {{-- MENSUAL --}}
                <div class="tab-pane fade show active" id="mensual" role="tabpanel">
                  <div class="row g-3">
                    @foreach($monthlyPlans as $plan)
                      <div class="col-md-4">
                        <div class="card rounded-3 h-100 p-3 border-0 ">
                          <h3 class="fs-3 font-bankgothic fw-bold mb-1  text-turquesa">
                            {{ $plan->name }}
                          </h3>
                          <p class="text-secondary small mb-2">
                            Plan mensual flexible.
                          </p>
                          <div class="price p-0">
                            <p class="fs-4">U$D {{ number_format($plan->price, 2, ',', '.') }}
                              <span class="fs-6 text-secondary">/mes</span></p>
                          </div>
                          @if(!empty($plan->features))
                            <ul class="small ps-3 mb-3">
                              @foreach($plan->features as $f)
                                <li>
                                  <i class="fa-solid fa-circle-check text-turquesa me-2"></i>{{ trim($f) }}
                                </li>
                              @endforeach
                            </ul>
                          @endif
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>

                {{-- ANUAL --}}
                <div class="tab-pane fade" id="anual" role="tabpanel">
                  <div class="row g-3 ">
                    @foreach($annualPlans as $plan)
                      @php
                        $monthly = $monthlyPlans->get($plan->name);
                        $discount = $plan->discount;
                      @endphp
                      <div class="col-md-4">
                        <div class="card rounded-3 h-100 p-3 border-0  ">
                          <h3 class="fs-3 font-bankgothic fw-bold mb-1  text-turquesa">
                            {{ $plan->name }}
                          </h3>
                          <p class="text-light small mb-2 badge bg-azul">
                            Plan anual
                            @if($discount)
                              con <span
                                class="text-turquesa fw-bold">{{ $discount }}% OFF</span>
                            @endif
                          </p>
                          <div class="price p-0">
                            <p class="fs-4">U$D {{ number_format($plan->price, 2, ',', '.') }}
                              <span class="fs-6 text-secondary">/mes</span></p>
                          </div>

                          @if($discount && $monthly)
                            <small class="text-turquesa d-block mb-2">
                              En lugar de U$D {{ number_format($monthly->price * 12, 2, ',', '.') }}
                              pagando mes a mes.
                            </small>
                          @endif

                          @if(!empty($plan->features))
                            <ul class="small ps-3 mb-3">
                              @foreach($plan->features as $f)
                                <li>
                                  <i class="fa-solid fa-circle-check text-turquesa me-2"></i>{{ trim($f) }}
                                </li>
                              @endforeach
                            </ul>
                          @endif

                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>

              </div>
            </div>
          </div>
        @endif

      </div>
    </div>
  </section>

@endsection
