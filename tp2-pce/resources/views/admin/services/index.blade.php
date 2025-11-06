@extends('layouts.app')

@section('title', 'Listado de servicios')

@section('content')

  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container">
      <h1 class="fs-1 font-bankgothic fw-bold mb-1">Listado de Servicios</h1>
      <div class="my-2 d-flex flex-wrap justify-content-between align-items-center gap-2">
        <p class="text-secondary mb-0">Listado general de servicios registrados en el sistema.</p>
        <div class="d-flex gap-2">
          <a href="{{ route('admin.services.create') }}" class="btn btn-turquesa">
            <i class="bi bi-plus-circle me-2"></i>Nuevo servicio
          </a>
          <a href="{{ route('admin.categories.index') }}" class="btn btn-turquesa">
            <i class="bi bi-tags me-1"></i> Categorías
          </a>
        </div>
      </div>
    </div>
  </section>

  <section class="container py-5">
    {{-- Mensaje de éxito --}}
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    <div class="bg-azul rounded shadow-sm mb-3">
      <button class="btn btn-azul  text-white w-100 text-start rounded-lg py-4" type="button" data-bs-toggle="collapse"
              data-bs-target="#filtrosServicios" aria-expanded="false" aria-controls="filtrosServicios">
        <i class="bi bi-funnel me-2"></i>Filtros de búsqueda
      </button>
      <div class="collapse" id="filtrosServicios">
        <div class="p-3 border-top border-light bg-azul">
          <form method="GET" action="{{ route('admin.services.index') }}" class="row g-2">
            <div class="col-md-4 ">
              <input type="text" name="name" class="form-control" placeholder="Nombre del servicio"
                     value="{{ request('name') }}">
            </div>
            <div class="col-md-4">
              <select name="category_id" class="form-select">
                <option value="">Todas las categorías</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-4">
              <select name="status" class="form-select">
                <option value="">Todos los estados</option>
                <option value="Activo" {{ request('status') == 'Activo' ? 'selected' : '' }}>Activo</option>
                <option value="Pausado" {{ request('status') == 'Pausado' ? 'selected' : '' }}>Pausado</option>
                <option value="Inactivo" {{ request('status') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
              </select>
            </div>
            <div class="col-md-12 ">
              <div class="d-flex justify-content-end gap-2 mt-2">
                <button type="submit" class="btn btn-turquesa"><i class="bi bi-filter"></i> Filtrar</button>
                <a href="{{ route('admin.services.index') }}" class="btn btn-turquesa"><i class="bi bi-x-circle"></i>
                  Limpiar</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>


    {{-- Tabla de servicios --}}
    <div class="shadow-sm p-3 bg-azul  rounded-2 d-none d-lg-block">
      <div class="card border-light border-2 shadow-sm">

        <div class="table-responsive">

          <table class="table table-striped align-middle mb-0 ">
            <thead>
            <tr class="table-dark font-bankgothic ">
              <th scope="col" class="text-center rounded-rounded-tl-lg">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Categoría</th>
              <th scope="col">Subtítulo</th>
              <th scope="col" class="text-center">Estado</th>
              <th scope="col" class="text-center">Plan</th>
              <th scope="col" class="text-center">Actualizado</th>
              <th scope="col" class="text-center rounded-tr-full">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($services as $service)
              <tr>
                <td class="text-center">{{ $service->id }}</td>

                <td>{{ $service->name }}</td>
                <td>{{ $service->category->name ?? 'Sin categoría' }}</td>
                <td class="text-secondary">{{ Str::limit($service->subtitle, 45) }}</td>

                <td class="text-center">
                  @if($service->status === 'Activo')
                    <span class="badge bg-turquesa">{{ $service->status }}</span>
                  @elseif($service->status === 'Pausado')
                    <span class="badge bg-warning text-dark">{{ $service->status }}</span>
                  @else
                    <span class="badge bg-danger">{{ $service->status }}</span>
                  @endif
                </td>


                <td class="text-center">
                  @php
                    $types = $service->plans->pluck('type')->unique()->toArray();
                  @endphp

                  @if(in_array('mensual', $types))
                    <span class="badge bg-azul text-light">Mensual/Anual</span>
                  @elseif(in_array('único', $types))
                    {{-- Solo si no hay mensual, mostramos único --}}
                    <span class="badge bg-success">Único</span>
                  @else
                    @if(empty($types))
                      <span class="text-muted">Sin planes</span>
                    @endif
                  @endif
                </td>


                <td class="text-center small">
                  {{ $service->updated_at->format('d/m/Y') }}
                </td>

                <td class="text-center">
                  @php
                    // Agrupar planes existentes por tipo y nombre
                    $byType   = $service->plans->groupBy('type');      // 'único' | 'mensual' | 'anual'
                    $mensual  = optional($byType->get('mensual'))?->keyBy('name') ?? collect();
                    $unique   = optional($byType->get('único'))?->first();

                    // Planes mensuales por nombre (coinciden con los del modal/controlador)
                    $pBasico  = $mensual->get('Básico');
                    $pPro     = $mensual->get('Pro');           // UI muestra “Profesional”
                    $pEmp     = $mensual->get('Empresarial');

                    // Modo por defecto del modal
                    $defaultMode = $unique ? 'unico' : 'mensual';

                    // ¿crear o editar?
                    $isUpdate   = $service->plans->isNotEmpty();
                    $formAction = $isUpdate
                      ? route('admin.plans.update', $service)   // PUT
                      : route('admin.plans.store',  $service);  // POST

                    // Modal ID único por servicio
                    $modalId = 'planModal-'.$service->id;
                  @endphp

                  {{-- Botón para abrir modal (crea/edita según tenga planes) --}}
                  <button class="btn  btn-turquesa-light"
                          data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                    <i class="dark fa-solid  {{ $isUpdate ? 'fa-pen-to-square' : 'fa-plus fa-fade' }}"></i>
                  </button>
                  <a href="{{ route('admin.services.show', $service->id) }}" class="btn btn-azul " title="Ver">
                    <i class="fa-solid fa-eye"></i>                    </button>
                  </a>
                  <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-azul "
                     title="Editar">
                    <i class="fa-solid fa-pen"></i>                    </button>
                  </a>
                  <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST"
                        onsubmit="return confirm('¿Seguro que querés eliminar este servicio?')"
                        style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger " title="Eliminar">
                      <i class="fa-solid fa-trash"></i></button>
                  </form>
                  @include('components.plan-modal', [
                    'service'     => $service,
                    'modalId'     => $modalId,
                    'defaultMode' => $defaultMode,
                    'uniquePlan'  => $unique,     // plan único (o null)
                    'pBasico'     => $pBasico,    // mensual Básico (o null)
                    'pPro'        => $pPro,       // mensual Pro (o null)
                    'pEmp'        => $pEmp,       // mensual Empresarial (o null)
                    'formAction'  => $formAction, // store o update
                    'isUpdate'    => $isUpdate,   // true/false
                  ])
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="text-center text-secondary py-4">No hay servicios registrados.</td>
              </tr>
            @endforelse
            </tbody>
          </table>
        </div>

      </div>
    </div>

    <div class="d-block d-lg-none">
      <div class="row">
        @forelse($services as $service)
          <div class="col-12 mb-3">
            <div class="card shadow-sm bg-azul">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <div class="small mb-2"><span
                      class="text-turquesa">Id:</span>{{ $service->id }}</div>
                  {{-- Badge estado --}}
                  @if($service->status === 'Activo')
                    <span class="badge bg-success">{{ $service->status }}</span>
                  @elseif($service->status === 'Pausado')
                    <span class="badge bg-warning text-dark">{{ $service->status }}</span>
                  @else
                    <span class="badge bg-danger">{{ $service->status }}</span>
                  @endif
                </div>
                <h5 class="card-title font-bankgothic text-turquesa mb-1">{{ $service->name }}</h5>
                <div class="small mb-2"><span
                    class="text-turquesa">Actualizado:</span></i> {{ $service->updated_at->format('d/m/Y') }}</div>
                <div class="mb-1"><span
                    class="text-turquesa">Categoría:</span> {{ $service->category->name ?? 'Sin categoría' }}</div>
                <div class="mb-1 "><span
                    class="text-turquesa">Subtítulo:</span> {{ Str::limit($service->subtitle, 45) }}</div>
                <div class="d-flex justify-content-center gap-2 bg-light p-2 rounded-2">
                  <button
                    type="button"
                    class="btn btn-turquesa"
                    data-bs-toggle="modal"
                    data-bs-target="#planModal"
                    data-service-id="{{ $service->id }}"
                    data-service-name="{{ $service->name }}"
                  >
                    <i class="bi bi-plus-circle me-2"></i>Agregar plan
                  </button>
                  {{-- Ver --}}
                  <a href="{{ route('admin.services.show', $service->id) }}" class="btn btn-dark " title="Ver">
                    <i class="bi bi-eye"></i>
                  </a>
                  {{-- Editar --}}
                  <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-turquesa "
                     title="Editar">
                    <i class="bi bi-pencil"></i>
                  </a>
                  {{-- Eliminar --}}
                  <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST"
                        onsubmit="return confirm('¿Seguro que querés eliminar este servicio?')"
                        style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger " title="Eliminar">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12 text-center text-secondary py-4">
            No hay servicios registrados.
          </div>
        @endforelse
      </div>
    </div>

    {{-- Paginación --}}
    <div class="mt-4 d-flex justify-content-end">
      {{ $services->links('pagination::bootstrap-5') }}
    </div>
  </section>
  @once
    @include('components.plan-modal', ['modalId' => 'planModal'])
  @endonce

@endsection
