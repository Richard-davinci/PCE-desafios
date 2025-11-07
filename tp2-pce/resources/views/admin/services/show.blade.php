@extends('layouts.app')

@section('title', $service->name)

@section('content')
  <main>
    <section class="d-flex align-items-center bg-gradient-dark text-light">
      <div class="container py-5">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
          <div>
            <h1 class="fs-1 fw-bold font-bankgothic mb-3">{{ $service->name }}</h1>
            <p class="text-blanco mb-0">{{ $service->subtitle }}</p>
          </div>
        </div>
      </div>
    </section>
    <section class="container">
      <x-breadcrumb
        :items="[['label' => 'Servicios',   'route' => 'admin.services.index'], ['label' => $service->name]  ]"
        separator="›"/>
    </section>

    <!-- Descripción  -->
    <section class="container py-5">
      <div class="row g-4">
        <!-- Columna Izquierda -->
        <div class="col-lg-4">
          <div class="card bg-azul text-light border-light shadow-sm h-100">
            <div class="card-body">
              @if($service->image)
                <img src="{{ asset('storage/img/servicios/' . $service->image) }}"
                     alt="{{ $service->name }}" class="img-fluid img-thumb mb-3">

              @endif
              <div class="service-meta small">
                <div class="d-flex justify-content-between">
                  <p>Categoría</p><span>{{ $service->category->name }}</span>
                </div>
                <div class="d-flex justify-content-between">
                  <p>Estado</p>
                  <span class="{{ $service->status === 'Activo' ? 'text-success' : 'text-warning' }}">
                  {{ $service->status }}
                </span>
                </div>
                <div class="d-flex justify-content-between">
                  <p>Última actualización</p><span>{{ $service->updated_at->format('d/m/Y') }}</span>
                </div>
              </div>
              <div class="d-grid mt-5">
                <a href="{{ route('admin.services.index') }}" class="btn btn-turquesa">
                  <i class="bi bi-arrow-left me-1"></i> Volver
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Columna Derecha -->
        <div class="col-lg-8">
          <!-- Descripción -->
          <div class="card bg-azul text-light border-light shadow-sm">
            <div class="card-body">
              <h2 class="fs-4 text-turquesa mb-2 font-bankgothic">Descripción</h2>
              <p class="mb-3">{{ $service->description }}</p>
            </div>
          </div>

          <!-- Condiciones -->
          @if(!empty($service->conditions))
            <div class="card bg-azul text-light border-light shadow-sm mt-3">
              <div class="card-body">
                <h2 class="fs-4 text-turquesa font-bankgothic mb-2">Condiciones</h2>
                <ul class="small mb-0">
                  @foreach(is_array($service->conditions) ? $service->conditions : explode(',', $service->conditions) as $cond)
                    @if(trim($cond) !== '')
                      <li><p><i class="bi bi-check2 me-1 text-turquesa"></i>{{ trim($cond) }}</p>
                      </li>
                    @endif
                  @endforeach
                </ul>
              </div>
            </div>
          @endif
        </div>
      </div>
    </section>

    @php
      $monthly = $service->plans->where('type', 'mensual');
      $annual  = $service->plans->where('type', 'anual');
      $unique  = $service->plans->where('type', 'único');

      $hasMonthly = $monthly->isNotEmpty();
      $hasAnnual  = $annual->isNotEmpty();
      $hasUnique  = $unique->isNotEmpty();

      $typesAvailable = collect([
        'mensual' => $hasMonthly,
        'anual'   => $hasAnnual,
        'único'   => $hasUnique,
      ])->filter()->keys(); //['único'] o ['mensual','anual']
    @endphp

    <section class="bg-gradient-dark text-light">
      <div class="container py-5">
        <div class="card bg-azul text-light border-light shadow-sm mt-3">
          <div class="card-body">

            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 mb-2">
              <h2 class="fs-3 font-bankgothic text-turquesa mb-0">Planes disponibles</h2>

              {{-- Mostrar tabs solo si hay 2+ tipos --}}
              @if($typesAvailable->count() >= 2)
                <ul class="nav tabs-underline justify-content-center mb-0" id="planTabs" role="tablist">
                  @if($hasMonthly)
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active font-bankgothic fs-5" id="mensual-tab"
                              data-bs-toggle="tab" data-bs-target="#mensual" type="button"
                              role="tab" aria-controls="mensual" aria-selected="true">
                        Mensual
                      </button>
                    </li>
                  @endif
                  @if($hasAnnual)
                    <li class="nav-item" role="presentation">
                      <button class="nav-link font-bankgothic fs-5" id="anual-tab"
                              data-bs-toggle="tab" data-bs-target="#anual" type="button"
                              role="tab" aria-controls="anual" aria-selected="false">
                        Anual
                      </button>
                    </li>
                  @endif
                  @if($hasUnique)
                    <li class="nav-item" role="presentation">
                      <button class="nav-link font-bankgothic fs-5" id="unico-tab"
                              data-bs-toggle="tab" data-bs-target="#unico" type="button"
                              role="tab" aria-controls="unico" aria-selected="false">
                        Único
                      </button>
                    </li>
                  @endif
                </ul>
              @endif
            </div>

            @if($typesAvailable->count() >= 2)
              {{-- CON TABS: contenido por cada tipo presente --}}
              <div class="tab-content mt-4" id="planTabsContent">

                @if($hasMonthly)
                  <div class="tab-pane fade show active" id="mensual" role="tabpanel">
                    <div class="row g-3">
                      @foreach($monthly as $plan)
                        @php
                          $features = is_array($plan->features) ? $plan->features
                                    : (is_string($plan->features) ? (json_decode($plan->features, true) ?? []) : []);
                          $displayName = $plan->name === 'Pro' ? 'Profesional' : $plan->name;
                        @endphp
                        <div class="col-md-4">
                          <div class="card rounded-3 h-100 p-3">
                            <h3 class="fs-4 font-bankgothic text-turquesa fw-bold mb-1">{{ $displayName }}</h3>
                            <p class="text-secondary small mb-2">Ideal para emprendedores</p>
                            <div class="price fs-3 mb-2">
                              AR$ {{ number_format($plan->price, 0, ',', '.') }}
                              <span class="fs-6 text-secondary">/mes</span>
                            </div>
                            <ul class="small ps-3 mb-3">
                              @foreach($features as $f)
                                <li>{{ trim($f) }}</li>
                              @endforeach
                            </ul>
                            <div class="d-grid">
                              <a href="#" class="btn btn-turquesa mt-2">Elegir plan</a>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                @endif

                @if($hasAnnual)
                  <div class="tab-pane fade {{ $hasMonthly ? '' : 'show active' }}" id="anual" role="tabpanel">
                    <div class="row g-3">
                      @foreach($annual as $plan)
                        @php
                          $features = is_array($plan->features) ? $plan->features
                                    : (is_string($plan->features) ? (json_decode($plan->features, true) ?? []) : []);
                          $displayName = $plan->name === 'Pro' ? 'Profesional' : $plan->name;
                        @endphp
                        <div class="col-md-4">
                          <div class="card rounded-3 h-100 p-3">
                            <h3 class="fs-4 font-bankgothic text-turquesa fw-bold mb-1">{{ $displayName }}</h3>
                            <p class="text-secondary small mb-2">Plan anual con descuento</p>
                            <div class="price fs-3 mb-2">
                              AR$ {{ number_format($plan->price, 0, ',', '.') }}
                              <span class="fs-6 text-secondary">/año</span>
                            </div>
                            <ul class="small ps-3 mb-3">
                              @foreach($features as $f)
                                <li>{{ trim($f) }}</li>
                              @endforeach
                            </ul>
                            <div class="d-grid">
                              <a href="#" class="btn btn-turquesa mt-2">Contratar anual</a>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                @endif

                @if($hasUnique)
                  <div class="tab-pane fade {{ (!$hasMonthly && !$hasAnnual) ? 'show active' : '' }}" id="unico"
                       role="tabpanel">
                    <div class="row g-3">
                      @foreach($unique as $plan)
                        @php
                          $features = is_array($plan->features) ? $plan->features
                                    : (is_string($plan->features) ? (json_decode($plan->features, true) ?? []) : []);
                          // Para Único el nombre puede ser el que definas; si usás 'Empresarial' lo mostramos tal cual
                          $displayName = $plan->name === 'Pro' ? 'Profesional' : $plan->name;
                        @endphp
                        <div class="col-md-4">
                          <div class="card rounded-3 h-100 p-3">
                            <h3 class="fs-4 font-bankgothic text-turquesa fw-bold mb-1">{{ $displayName }}</h3>
                            <p class="text-secondary small mb-2">Pago único</p>
                            <div class="price fs-3 mb-2">
                              AR$ {{ number_format($plan->price, 0, ',', '.') }}
                            </div>
                            <ul class="small ps-3 mb-3">
                              @foreach($features as $f)
                                <li>{{ trim($f) }}</li>
                              @endforeach
                            </ul>
                            <div class="d-grid">
                              <a href="#" class="btn btn-turquesa mt-2">Contratar</a>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                @endif

              </div>
            @else
              {{-- SIN TABS: render directo del único tipo existente --}}
              @if($hasUnique)
                <div class="row g-3 mt-3">
                  @foreach($unique as $plan)
                    @php
                      $features = is_array($plan->features) ? $plan->features
                                : (is_string($plan->features) ? (json_decode($plan->features, true) ?? []) : []);
                      $displayName = $plan->name === 'Pro' ? 'Profesional' : $plan->name;
                    @endphp
                    <div class="col-md-4">
                      <div class="card rounded-3 h-100 p-3">
                        <h3 class="fs-4 font-bankgothic text-turquesa fw-bold mb-1">{{ $displayName }}</h3>
                        <p class="text-secondary small mb-2">Pago único</p>
                        <div class="price fs-3 mb-2">
                          AR$ {{ number_format($plan->price, 0, ',', '.') }}
                        </div>
                        <ul class="small ps-3 mb-3">
                          @foreach($features as $f)
                            <li>{{ trim($f) }}</li>
                          @endforeach
                        </ul>
                        <div class="d-grid">
                          <a href="#" class="btn btn-turquesa mt-2">Contratar</a>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              @endif

              @if($hasMonthly)
                <div class="row g-3 mt-3">
                  @foreach($monthly as $plan)
                    @php
                      $features = is_array($plan->features) ? $plan->features
                                : (is_string($plan->features) ? (json_decode($plan->features, true) ?? []) : []);
                      $displayName = $plan->name === 'Pro' ? 'Profesional' : $plan->name;
                    @endphp
                    <div class="col-md-4">
                      <div class="card rounded-3 h-100 p-3">
                        <h3 class="fs-4 font-bankgothic text-turquesa fw-bold mb-1">{{ $displayName }}</h3>
                        <p class="text-secondary small mb-2">Ideal para emprendedores</p>
                        <div class="price fs-3 mb-2">
                          AR$ {{ number_format($plan->price, 0, ',', '.') }} <span
                            class="fs-6 text-secondary">/mes</span>
                        </div>
                        <ul class="small ps-3 mb-3">
                          @foreach($features as $f)
                            <li>{{ trim($f) }}</li>
                          @endforeach
                        </ul>
                        <div class="d-grid">
                          <a href="#" class="btn btn-turquesa mt-2">Elegir plan</a>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              @endif

              @if($hasAnnual)
                <div class="row g-3 mt-3">
                  @foreach($annual as $plan)
                    @php
                      $features = is_array($plan->features) ? $plan->features
                                : (is_string($plan->features) ? (json_decode($plan->features, true) ?? []) : []);
                      $displayName = $plan->name === 'Pro' ? 'Profesional' : $plan->name;
                    @endphp
                    <div class="col-md-4">
                      <div class="card rounded-3 h-100 p-3">
                        <h3 class="fs-4 font-bankgothic text-turquesa fw-bold mb-1">{{ $displayName }}</h3>
                        <p class="text-secondary small mb-2">Plan anual con descuento</p>
                        <div class="price fs-3 mb-2">
                          AR$ {{ number_format($plan->price, 0, ',', '.') }} <span
                            class="fs-6 text-secondary">/año</span>
                        </div>
                        <ul class="small ps-3 mb-3">
                          @foreach($features as $f)
                            <li>{{ trim($f) }}</li>
                          @endforeach
                        </ul>
                        <div class="d-grid">
                          <a href="#" class="btn btn-turquesa mt-2">Contratar anual</a>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              @endif
            @endif

          </div>
        </div>
      </div>
    </section>

  </main>
@endsection
