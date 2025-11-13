@extends('layouts.app')

@section('title', 'Listado de servicios')

@section('content')

  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container">
      <h1 class="fs-1 font-bankgothic fw-bold mb-1">Servicios</h1>
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
    <x-alert type="success" :message="session('success')"/>

    <div class="bg-azul rounded shadow-sm mb-3">
      <button class="btn btn-azul  text-white w-100 text-start rounded-lg py-4 fs-5" type="button"
              data-bs-toggle="collapse"
              data-bs-target="#filtrosServicios" aria-expanded="false" aria-controls="filtrosServicios">
        <i class="bi bi-funnel me-2"></i>Filtros de búsqueda
      </button>
      <div class="collapse show" id="filtrosServicios">
        <div class="p-3 border-top border-light bg-azul">
          <form method="GET" action="{{ route('admin.services.index') }}" class="row g-2">
            <div class="col-md-4 ">
              <label for="name" class="mb-1">Nombre</label>
              <input type="text" name="name" class="form-control" placeholder="Ingrese el nombre del servicio"
                     value="{{ request('name') }}">
            </div>
            <div class="col-md-4">
              <label for="category_id" class="mb-1">Categorías</label>
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
              <label for="status" class="mb-1">Estado</label>
              <select name="status" class="form-select">
                <option value="">Todos los estados</option>
                <option value="Activo" {{ request('status') == 'Activo' ? 'selected' : '' }}>Activo
                </option>
                <option value="Pausado" {{ request('status') == 'Pausado' ? 'selected' : '' }}>Pausado
                </option>
                <option value="Borrador" {{ request('status') == 'Borrador' ? 'selected' : '' }}>
                  Borrador
                </option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="plan_mode" class="mb-1">Tipo de plan</label>
              <select name="plan_mode" class="form-select">
                <option value="">Todos los planes</option>
                <option value="none" {{ request('plan_mode') === 'none' ? 'selected' : '' }}>
                  Sin planes
                </option>
                <option value="unico" {{ request('plan_mode') === 'unico' ? 'selected' : '' }}>
                  Plan único
                </option>
                <option value="mensual" {{ request('plan_mode') === 'mensual' ? 'selected' : '' }}>
                  Planes mensuales/anuales
                </option>
              </select>
            </div>

            <div class="col-md-12 ">
              <div class="d-flex justify-content-end gap-2 mt-2">
                <button type="submit" class="btn btn-turquesa"><i class="bi bi-filter"></i> Filtrar
                </button>
                <a href="{{ route('admin.services.index') }}" class="btn btn-turquesa"><i
                    class="bi bi-x-circle"></i>
                  Limpiar</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>


    {{-- Tabla de servicios --}}
    <div class="shadow-sm p-3 bg-azul  rounded-2">
      <h2 class="fs-3 font-bankgothic fw-bold">Listado de de servicios</h2>
      <div class="card border-light border-2 shadow-sm">

        <div class="table-responsive">

          <table class="table table-striped align-middle mb-0 ">
            <thead>
            <tr class="table-dark font-bankgothic ">
              <th scope="col" class="text-center rounded-rounded-tl-lg">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Categoría</th>
              <th scope="col">Estado</th>
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
                <td class="text-center">
                  @switch($service->status)
                    @case('Activo')
                      <span class="badge bg-turquesa">Activo</span>
                      @break
                    @case('Pausado')
                      <span class="badge bg-azul">Pausado</span>
                      @break
                    @case('Borrador')
                      <span class="badge bg-secondary">Borrador</span>
                      @break
                    @default
                      <span
                        class="badge text-bg-secondary">{{ $service->status }}</span>
                  @endswitch
                </td>

                @php
                  $hasPlans = $service->plans->isNotEmpty();
                @endphp
                @php
                  // Extraigo los tipos de plan únicos que tiene este servicio
                  $types = $service->plans->pluck('type')->unique()->toArray();
                @endphp

                <td class="text-center">
                  @if(empty($types))
                    <span class="badge bg-secondary text-secondary text-light">Sin planes</span>
                  @else
                    @if(in_array('único', $types))
                      <span class="badge bg-turquesa">Único</span>
                    @endif
                    @if(in_array('mensual', $types))
                      <span class="badge bg-azul">Mensual</span>
                    @endif
                    @if(in_array('anual', $types))
                      <span class="badge bg-azul">Anual</span>
                    @endif
                  @endif
                </td>


                <td class="text-center">
                  {{ $service->updated_at->format('d/m/Y') }}
                </td>
                {{-- Detalle de planes --}}
                <td>
                  <div class="d-flex flex-wrap justify-content-center gap-2">

                    {{-- Ver --}}
                    <a href="{{ route('admin.services.show', $service->id) }}"
                       class="btn  btn-azul" title="Ver">
                      <i class="fa-solid fa-eye"></i>
                    </a>

                    {{-- Agregar / Editar planes --}}
                    @if(!$hasPlans)
                      <a href="{{ route('admin.services.plans.create', $service) }}"
                         class="btn btn-azul" title="Agregar plan">
                        <i class="fa-solid fa-plus"></i>
                      </a>
                    @else
                      <a href="{{ route('admin.services.plans.edit', $service) }}"
                         class="btn btn-azul" title="Editar planes">
                        <i class="fa-solid fa-sliders"></i>
                      </a>
                    @endif


                    {{-- Editar --}}
                    <a href="{{ route('admin.services.edit', $service->id) }}"
                       class="btn  btn-azul" title="Editar servicios">
                      <i class="fa-solid fa-pen"></i>
                    </a>

                    {{-- Eliminar --}}
                    <form id="deleteForm{{ $service->id }}"
                          action="{{ route('admin.services.destroy', $service->id) }}"
                          method="POST"
                          class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="button"
                              id="deleteBtn{{ $service->id }}"
                              class="btn btn-danger"
                              title="Eliminar"
                              data-has-subs="{{ $service->subscriptions_count > 0 ? '1' : '0' }}"
                              onclick="confirmDelete({{ $service->id }})">
                        <i class="fa-solid fa-trash"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="text-center text-secondary py-4">No hay servicios registrados.
                </td>
              </tr>
            @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    {{-- Paginación --}}
    <div class="mt-4 d-flex justify-content-end">
      {{ $services->links('pagination::bootstrap-5') }}
    </div>
  </section>

  <script>
    function confirmDelete(id) {
      const btn = document.getElementById(`deleteBtn${id}`);
      const hasSubs = btn?.dataset.hasSubs === '1';

      if (hasSubs) {
        Swal.fire({
          title: 'No se puede eliminar',
          text: 'Este servicio tiene usuarios suscriptos. Primero anulá o transferí las suscripciones.',
          icon: 'info',
          confirmButtonText: 'Entendido',
          background: '#112b3a',
          color: '#cfd6dc',
          customClass: {
            popup: 'swal-custom-popup',
            title: 'swal-custom-title',
            confirmButton: 'swal-custom-confirm',
            cancelButton: 'swal-custom-cancel',
          },
        });
        return;
      }

      Swal.fire({
        title: '¿Eliminar servicio?',
        text: 'Esta acción no se puede deshacer.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        background: '#112b3a',
        color: '#cfd6dc',
        customClass: {
          popup: 'swal-custom-popup',
          title: 'swal-custom-title',
          confirmButton: 'swal-custom-confirm',
          cancelButton: 'swal-custom-cancel',
        },
      }).then((result) => {
        if (result.isConfirmed) {
          const form = document.getElementById(`deleteForm${id}`);
          if (form) {
            form.submit();
          }
        }
      });
    }
  </script>

@endsection
