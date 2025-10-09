@extends('layouts.admin')

@section('title', 'Listado de servicios')

@section('content')

  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container mb-4">
      <h1 class="fs-1 font-bankgothic fw-bold mb-1">Servicios</h1>
      <p class="text-secondary mb-0">Listado general de servicios registrados en el sistema.</p>
    </div>
  </section>

  <section class="container py-5">
    {{-- Botón crear nuevo --}}
    <div class="d-flex justify-content-end mb-4">
      <a href="{{ route('services.create') }}" class="btn btn-turquesa">
        <i class="bi bi-plus-circle me-2"></i>Nuevo servicio
      </a>
    </div>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    {{-- Tabla de servicios --}}
    <div class="table-responsive">
      <table class="table table-dark table-striped align-middle border border-secondary shadow-sm">
        <thead class="text-turquesa font-bankgothic">
        <tr>
          <th scope="col" class="text-center">#</th>
          <th scope="col">Imagen</th>
          <th scope="col">Nombre</th>
          <th scope="col">Categoría</th>
          <th scope="col">Subtítulo</th>
          <th scope="col" class="text-center">Estado</th>
          <th scope="col" class="text-center">Actualizado</th>
          <th scope="col" class="text-center">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @forelse($services as $service)
          <tr>
            <td class="text-center">{{ $service->id }}</td>

            {{-- Imagen --}}
            <td>
              @if($service->image)
                <img src="{{ asset('storage/img/servicios/' . $service->image) }}"
                     alt="{{ $service->name }}"
                     class="img-thumbnail"
                     style="width: 80px; height: 80px; object-fit: cover;">
              @else
                <span class="text-muted fst-italic">Sin imagen</span>
              @endif
            </td>

            {{-- Nombre --}}
            <td class="fw-semibold">{{ $service->name }}</td>

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
                <a href="{{ route('services.show', $service->id) }}" class="btn btn-outline-light btn-sm" title="Ver">
                  <i class="bi bi-eye"></i>
                </a>
                {{-- Editar --}}
                <a href="{{ route('services.edit', $service->id) }}" class="btn btn-outline-turquesa btn-sm" title="Editar">
                  <i class="bi bi-pencil"></i>
                </a>
                {{-- Eliminar --}}
                <form action="{{ route('services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('¿Seguro que querés eliminar este servicio?')" style="display:inline-block;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-outline-danger btn-sm" title="Eliminar">
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

    {{-- Paginación --}}
    <div class="mt-4 d-flex justify-content-center">
      {{ $services->links('pagination::bootstrap-5') }}
    </div>
  </section>

@endsection
