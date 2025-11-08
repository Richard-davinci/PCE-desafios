@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2">
      <div class="mb-4">
        <h1 class="fs-1 font-bankgothic fw-bold mb-1">Dashboard de {{ Auth::user()->name }}</h1>
        <p class="text-blanco mb-2">
          Resumen general del sistema: usuarios, servicios y categorías. Acceso rápido a la gestión.
        </p>
      </div>
      <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('admin.services.index') }}" class="btn btn-turquesa">
          <i class="bi bi-layers me-1"></i> Servicios
        </a>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-turquesa">
          <i class="bi bi-tags me-1"></i> Categorías
        </a>
        <a href="{{ route('admin.users.index') }}" class="btn btn-turquesa">
          <i class="bi bi-people me-1"></i> Usuarios
        </a>
      </div>
    </div>
  </section>

  <section class="py-4 ">
    <div class="container">
      <div class="row g-3">

        {{-- Usuarios --}}
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card bg-azul text-light border-light">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <small class="text-blanco d-block">Usuarios totales</small>
                  <div class="fs-3 fw-bold">{{ $users->count() }}</div>
                </div>
                <span class="badge bg-turquesa">{{ $usersToday }} hoy</span>
              </div>

              {{-- Admins --}}
              <div class="mb-2">
                <div class="d-flex justify-content-between">
                  <span class="small">Administradores: {{ $rolesStats['admin']['count'] ?? 0 }}</span>
                  <span class="small">{{ $rolesStats['admin']['percent'] ?? 0 }}%</span>
                </div>
                <div class="progress" style="height: 6px;">
                  <div class="progress-bar bg-turquesa"
                       style="width: {{ $rolesStats['admin']['percent'] ?? 0 }}%"></div>
                </div>
              </div>

              {{-- Users --}}
              <div class="mb-2">
                <div class="d-flex justify-content-between">
                  <span class="small">Usuarios: {{ $rolesStats['user']['count'] ?? 0 }}</span>
                  <span class="small">{{ $rolesStats['user']['percent'] ?? 0 }}%</span>
                </div>
                <div class="progress" style="height: 6px;">
                  <div class="progress-bar bg-turquesa"
                       style="width: {{ $rolesStats['user']['percent'] ?? 0 }}%"></div>
                </div>
              </div>

              <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-turquesa mt-2">
                <i class="bi bi-people"></i> Ver usuarios
              </a>
            </div>
          </div>
        </div>

        {{-- Servicios --}}
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card bg-azul text-light border-light">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <small class="text-blanco d-block">Servicios totales</small>
                  <div class="fs-3 fw-bold">{{ $totalServices ?? 0 }}</div>
                </div>
                <span class="badge bg-turquesa">
                  Con planes: {{ $servicesWithPlansCount ?? 0 }}
                </span>
              </div>

              @php
                $servicesTotal = $totalServices ?? 0;
                $withPlans = $servicesWithPlansCount ?? 0;
                $withoutPlans = $servicesWithoutPlansCount ?? 0;
                $withPlansPercent = $servicesTotal ? round($withPlans * 100 / $servicesTotal) : 0;
                $withoutPlansPercent = $servicesTotal ? round($withoutPlans * 100 / $servicesTotal) : 0;
              @endphp

              {{-- Con planes --}}
              <div class="mb-2">
                <div class="d-flex justify-content-between">
                  <span class="small">Con planes: {{ $withPlans }}</span>
                  <span class="small">{{ $withPlansPercent }}%</span>
                </div>
                <div class="progress" style="height: 6px;">
                  <div class="progress-bar bg-turquesa" style="width: {{ $withPlansPercent }}%"></div>
                </div>
              </div>

              {{-- Sin planes --}}
              <div class="mb-2">
                <div class="d-flex justify-content-between">
                  <span class="small">Sin planes: {{ $withoutPlans }}</span>
                  <span class="small">{{ $withoutPlansPercent }}%</span>
                </div>
                <div class="progress" style="height: 6px;">
                  <div class="progress-bar bg-turquesa" style="width: {{ $withoutPlansPercent }}%"></div>
                </div>
              </div>

              <a href="{{ route('admin.services.index') }}" class="btn btn-sm btn-turquesa mt-2">
                <i class="bi bi-layers"></i> Ver servicios
              </a>
            </div>
          </div>
        </div>

        {{-- Categorías --}}
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card bg-azul text-light border-light">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <small class="text-blanco d-block">Categorías totales</small>
                  <div class="fs-3 fw-bold">{{ $totalCategories ?? 0 }}</div>
                </div>
                <span class="badge bg-turquesa">
                  Con servicios: {{ $categoriesWithServicesCount ?? 0 }}
                </span>
              </div>

              @php
                $catTotal = $totalCategories ?? 0;
                $catWith = $categoriesWithServicesCount ?? 0;
                $catWithPercent = $catTotal ? round($catWith * 100 / $catTotal) : 0;
                $catWithout = $catTotal - $catWith;
                $catWithoutPercent = $catTotal ? round($catWithout * 100 / $catTotal) : 0;
              @endphp

              {{-- Con servicios --}}
              <div class="mb-2">
                <div class="d-flex justify-content-between">
                  <span class="small">Con servicios: {{ $catWith }}</span>
                  <span class="small">{{ $catWithPercent }}%</span>
                </div>
                <div class="progress" style="height: 6px;">
                  <div class="progress-bar bg-turquesa" style="width: {{ $catWithPercent }}%"></div>
                </div>
              </div>

              {{-- Sin servicios --}}
              <div class="mb-2">
                <div class="d-flex justify-content-between">
                  <span class="small">Sin servicios: {{ $catWithout }}</span>
                  <span class="small">{{ $catWithoutPercent }}%</span>
                </div>
                <div class="progress" style="height: 6px;">
                  <div class="progress-bar bg-turquesa" style="width: {{ $catWithoutPercent }}%"></div>
                </div>
              </div>

              <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-turquesa mt-2">
                <i class="bi bi-tags"></i> Ver categorías
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Listados --}}
  <section class="py-4">
    <div class="container">
      <div class="row g-3">

        {{-- Últimos usuarios --}}
        <div class="col-lg-4">
          <div class="card bg-azul border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
              <h5 class="mb-0 font-bankgothic text-turquesa">Últimos usuarios</h5>
              <a href="{{ route('admin.users.index') }}" class="text-decoration-none text-turquesa small">
                Ver todos
              </a>
            </div>
            <div class="card-body p-2">
              @forelse(($latestUsers ?? []) as $user)
                <div
                  class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary small">
                  <div>
                    <div class="fw-semibold">{{ $user->name }}</div>
                    <div class="text-secondary">{{ $user->email }}</div>
                  </div>
                  <span class="badge bg-turquesa text-dark text-uppercase">{{ $user->role }}</span>
                </div>
              @empty
                <p class="text-secondary small mb-0">No hay usuarios recientes.</p>
              @endforelse
            </div>
          </div>
        </div>

        {{-- Últimos servicios --}}
        <div class="col-lg-4">
          <div class="card bg-azul border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
              <h5 class="mb-0 font-bankgothic text-turquesa">Últimos servicios</h5>
              <a href="{{ route('admin.services.index') }}" class="text-decoration-none text-turquesa small">
                Ver todos
              </a>
            </div>
            <div class="card-body p-2">
              @forelse(($latestServices ?? []) as $service)
                <div class="py-2 border-bottom border-secondary small">
                  <div class="fw-semibold">{{ $service->name }}</div>
                </div>
              @empty
                <p class="text-secondary small mb-0">No hay servicios recientes.</p>
              @endforelse
            </div>
          </div>
        </div>

        {{-- Últimas categorías --}}
        <div class="col-lg-4">
          <div class="card bg-azul border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
              <h5 class="mb-0 font-bankgothic text-turquesa">Últimas categorías</h5>
              <a href="{{ route('admin.categories.index') }}" class="text-decoration-none text-turquesa small">
                Ver todas
              </a>
            </div>
            <div class="card-body p-2">
              @forelse(($latestCategories ?? []) as $category)
                <div class="py-2 border-bottom border-secondary small">
                  <div class="fw-semibold">{{ $category->name }}</div>
                  <div class="text-secondary">
                    {{ $category->services_count ?? 0 }} servicios asociados
                  </div>
                </div>
              @empty
                <p class="text-secondary small mb-0">No hay categorías recientes.</p>
              @endforelse
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
