@extends('layouts.admin')

@section('title', 'Listado de servicios')


@section('content')
  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container">
      <h1 class="fs-1 font-bankgothic fw-bold mb-1">Servicios</h1>
      <div class="my-2 d-flex flex-wrap justify-content-between align-items-center gap-2">
        <p class="text-secondary mb-0">Listado general de servicios registrados en el sistema.</p>
        <div class="d-flex gap-2">
          <a href="{{ route('services.create') }}" class="btn btn-turquesa">
            <i class="bi bi-plus-circle me-2"></i>Nuevo servicio
          </a>
          <a href="{{ route('categories.index') }}" class="btn btn-turquesa">
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
          <form method="GET" action="{{ route('services.index') }}" class="row g-2">
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
                <a href="{{ route('services.index') }}" class="btn btn-turquesa"><i class="bi bi-x-circle"></i> Limpiar</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>


    {{-- Tabla de servicios --}}
    <div class="shadow-sm p-3 bg-azul  rounded-2">
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
              <th scope="col" class="text-center">Actualizado</th>
              <th scope="col" class="text-center rounded-tr-full">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($services as $service)
              <tr>
                <td class="text-center">{{ $service->id }}</td>

                {{-- Nombre --}}
                <td>{{ $service->name }}</td>

                {{-- Categoría --}}
                <td>{{ $service->category->name ?? 'Sin categoría' }}</td>

                {{-- Subtítulo --}}
                <td class="text-secondary">{{ Str::limit($service->subtitle, 45) }}</td>

                {{-- Estado --}}
                <td class="text-center">
                  @if($service->status === 'Activo')
                    <span class="badge bg-success">{{ $service->status }}</span>
                  @elseif($service->status === 'Pausado')
                    <span class="badge bg-warning text-dark">{{ $service->status }}</span>
                  @else
                    <span class="badge bg-danger">{{ $service->status }}</span>
                  @endif
                </td>

                {{-- Fecha actualización --}}
                <td class="text-center small">
                  {{ $service->updated_at->format('d/m/Y') }}
                </td>

                {{-- Acciones --}}
                <td class="text-center">
                  <div class="d-flex justify-content-center gap-2">
                    {{-- Ver --}}
                    <a href="{{ route('services.show', $service->id) }}" class="btn btn-dark " title="Ver">
                      <i class="bi bi-eye"></i>
                    </a>
                    {{-- Editar --}}
                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-turquesa " title="Editar">
                      <i class="bi bi-pencil"></i>
                    </a>
                    {{-- Eliminar --}}
                    <form action="{{ route('services.destroy', $service->id) }}" method="POST"
                          onsubmit="return confirm('¿Seguro que querés eliminar este servicio?')"
                          style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger " title="Eliminar">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  </div>
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

    {{-- Paginación --}}
    <div class="mt-4 d-flex justify-content-end">
      {{ $services->links('pagination::bootstrap-5') }}
    </div>
  </section>

@endsection
