@extends('layouts.app')

@section('title', 'Gestión de categorías')

@section('content')
  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container">
      <h1 class="fs-1 font-bankgothic fw-bold mb-1">Categorías</h1>
      <div class="my-2 d-flex flex-wrap justify-content-between align-items-center gap-2">
        <p class="text-secondary mb-0">Listado general de categorías registradas en el sistema.</p>
        <div>
          <a href="{{ route('admin.services.index') }}" class="btn btn-turquesa">
            <i class="bi bi-arrow-left me-1"></i> Volver
          </a>
          <button class="btn btn-turquesa" data-bs-toggle="modal" data-bs-target="#modalAgregarCategoria">
            <i class="bi bi-plus-circle me-2"></i>Agregar categoría
          </button>
          <x-categoryModal
            id="modalAgregarCategoria"
            title="Agregar Categoría"
            icon="bi-plus-circle"
            :action="route('admin.categories.store')"
          />
        </div>
      </div>
    </div>
  </section>
  <section class="container">
    <x-breadcrumb
      :items="[['label' => 'Servicios',   'route' => 'admin.services.index'],  ['label' => 'Listado de categorías']]"
      separator="›"/>
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
              <th class="text-center">Actualización</th>
              <th>Nombre de la categoría</th>
              <th class="text-center">Servicios asociados</th>
              <th class="text-end">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
              <tr>
                <td>{{ $category->id }}</td>
                <td class="text-center">
                  {{ $category->updated_at->format('d/m/Y H:i') }}
                </td>
                <td>{{ $category->name }}</td>
                <td class="text-center">
                    <span class="badge bg-turquesa text-light">
                      {{ $category->services_count ?? 0 }}
                    </span>
                </td>
                <td class="text-end">
                  <button class="btn btn-turquesa  text-light" data-bs-toggle="modal"
                          data-bs-target="#modalEditarCategoria{{ $category->id }}">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                        style="display:inline-block;"
                        onsubmit="return confirm('¿Seguro que deseas eliminar esta categoría?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger " title="Eliminar">
                      <i class="bi bi-trash "></i>
                    </button>
                  </form>
                </td>
              </tr>
              <!-- modal editar categoría -->
              <x-categoryModal
                :id="'modalEditarCategoria'.$category->id"
                title="Editar Categoría"
                icon="bi-pencil"
                :action="route('admin.categories.update', $category->id)"
                method="PUT"
                :name="$category->name"
              />
            @empty
              <tr>
                <td colspan="5" class="text-center text-secondary py-3">No hay categorías registradas.</td>
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
  <div class="modal fade" id="modalEditarCategoria{{ $category->id }}" tabindex="-1"
       aria-labelledby="modalEditarCategoriaLabel{{ $category->id }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content border-light">
        <div class="modal-header bg-azul">
          <h5 class="modal-title font-bankgothic" id="modalEditarCategoriaLabel{{ $category->id }}">
            <i class="bi bi-pencil me-2"></i>Editar Categoría
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-body ">
            <div class="card shadow-sm rounded-2 bg-azul">
              <div class="card-body">
                <label class="form-label" for="categoriaEditar{{ $category->id }}">Nombre de la
                  categoría</label>
                <input type="text" class="form-control" id="categoriaEditar{{ $category->id }}"
                       name="name" value="{{ $category->name }}" required>
              </div>
            </div>
          </div>
          <div class="modal-footer bg-azul">
            <button type="submit" class="btn btn-turquesa font-bankgothic">Guardar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
