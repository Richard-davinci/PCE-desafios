@extends('layouts.admin')

@section('title', 'Gestión de categorías')

@section('content')
  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container">
      <h1 class="fs-1 font-bankgothic fw-bold mb-1">Categorías</h1>
      <div class="my-2 d-flex flex-wrap justify-content-between align-items-center gap-2">
        <p class="text-secondary mb-0">Listado general de categorías registradas en el sistema.</p>
        <div>
          <button class="btn btn-turquesa" data-bs-toggle="modal" data-bs-target="#modalAgregarCategoria">
            <i class="bi bi-plus-circle me-2"></i>Agregar categoría
          </button>
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
    {{-- Mensaje de error --}}
    @if($errors->any())
      <div class="alert alert-danger">
        {{ implode('', $errors->all(':message')) }}
      </div>
    @endif

    <div class="shadow-sm p-3 bg-azul  rounded-2">
      <div class="card border-light border-2 shadow-sm">
        <div class="table-responsive">
          <table class="table table-striped align-middle mb-0">
            <thead>
            <tr class="table-dark font-bankgothic">
              <th>#</th>
              <th>Nombre de la categoría</th>
              <th class="text-center">Servicios asociados</th>
              <th class="text-end">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
              <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td class="text-center">
                    <span class="badge text-bg-secondary">
                      {{ $category->services_count ?? 0 }}
                    </span>
                </td>
                <td class="text-end">
                  <button class="btn btn-turquesa btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditarCategoria{{ $category->id }}">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                        style="display:inline-block;"
                        onsubmit="return confirm('¿Seguro que deseas eliminar esta categoría?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="text-center text-secondary py-3">No hay categorías registradas.</td>
              </tr>
            @endforelse
            </tbody>
          </table>
        </div>
      </div>
      {{-- Paginación --}}
    </div>
    <div class="mt-4 d-flex justify-content-end">
      {{ $categories->links('pagination::bootstrap-5') }}
    </div>
  </section>


  <div class="modal fade" id="modalAgregarCategoria" tabindex="-1" aria-labelledby="modalAgregarCategoriaLabel"
       aria-hidden="true">
    <div class="modal-dialog">
      <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalAgregarCategoriaLabel">Nueva Categoría</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <input type="text" class="form-control" name="name" placeholder="Nombre de la categoría" required>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-turquesa">Guardar</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Ejemplo de modal por cada categoría -->
  <div class="modal fade" id="modalEditarCategoria{{ $category->id }}" tabindex="-1"
       aria-labelledby="modalEditarCategoriaLabel{{ $category->id }}" aria-hidden="true">
    <div class="modal-dialog">
      <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditarCategoriaLabel{{ $category->id }}">Editar Categoría</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <input type="text" class="form-control" name="name" value="{{ $category->name }}" required>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-turquesa">Actualizar</button>
          </div>
        </div>
      </form>
    </div>
  </div>

@endsection
