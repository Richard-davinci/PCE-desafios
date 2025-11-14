@extends('layouts.app')

@section('title', 'Gestión de categorías')

@section('content')
  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container">
      <h1 class="fs-1 font-bankgothic fw-bold mb-1">Categorías</h1>

      <div class="my-2 d-flex flex-wrap justify-content-between align-items-center gap-2">
        <p class="text-blanco mb-0">
          Administra las categorías registradas en el sistema.
        </p>

        <div class="d-flex gap-2">
          <a href="{{ route('admin.services.index') }}" class="btn btn-turquesa">
            <i class="fa-solid fa-arrow-left me-1"></i> Volver
          </a>

          {{-- Botón abrir modal crear categoría --}}
          <button class="btn btn-turquesa"
                  data-bs-toggle="modal"
                  data-bs-target="#modalAgregarCategoria">
            <i class="fa-solid fa-plus me-2"></i> Agregar categoría
          </button>

          {{-- Modal crear categoría (componente) --}}
          <x-categoryModal
            id="modalAgregarCategoria"
            title="Agregar Categoría"
            icon="fa-solid fa-plus"
            :action="route('admin.categories.store')"
          />
        </div>
      </div>
    </div>
  </section>

  {{-- Breadcrumb --}}
  <div class="container">
    <x-breadcrumb
      :items="[
        ['label' => 'Servicios', 'route' => 'admin.services.index'],
        ['label' => 'Listado de categorías']
      ]"
      separator="›"
    />
  </div>

  <section class="container mt-3">
    <x-alert type="success" :message="session('success')"/>
    <x-alert type="danger" :message="session('error')"/>

    <div class="shadow-sm p-3 bg-azul rounded-2">
      <h2 class="font-bankgothic fs-3">Listado de categorias</h2>
      <div class="card border-light border-2 shadow-sm">
        <div class="table-responsive">

          <table class="table table-striped align-middle mb-0">
            <thead>
            <tr class="table-dark font-bankgothic">
              <th>#</th>
              <th class="text-center">Actualizado</th>
              <th>Nombre de la categoría</th>
              <th class="text-center">Cantidad servicios</th>
              <th class="text-end">Acciones</th>
            </tr>
            </thead>

            <tbody>
            @forelse($categories as $category)
              <tr>
                <td>{{ $category->id }}</td>
                <td class="text-center">
                  {{ $category->updated_at->format('d/m/Y') }}
                </td>
                <td>{{ $category->name }}</td>
                <td class="text-center">
                  <span class="badge bg-azul">
                    {{ $category->services_count ?? 0 }}
                  </span>
                </td>
                <td class="text-end">
                  {{-- Editar --}}
                  <a class="btn btn-azul"
                     data-bs-toggle="modal"
                     title="Editar"
                     data-bs-target="#modalEditarCategoria{{ $category->id }}">
                    <i class="fa-solid fa-pen"></i>
                  </a>
                  {{-- Modal --}}
                  <x-categoryModal
                    :id="'modalEditarCategoria' . $category->id"
                    title="Editar Categoría"
                    icon="fa-solid fa-pen"
                    :action="route('admin.categories.update', $category->id)"
                    method="PUT"
                    :name="$category->name"
                  />

                  {{-- Eliminar --}}
                  @if($category->services_count > 0)
                    <button type="button"
                            class="btn btn-secondary"
                            title="No se puede eliminar: tiene servicios asociados">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  @else
                    <form id="deleteForm{{ $category->id }}"
                          action="{{ route('admin.categories.destroy', $category->id) }}"
                          method="POST"
                          style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="button"
                              data-bs-toggle="tooltip"
                              class="btn btn-danger"
                              title="Eliminar"
                              onclick="confirmDelete({{ $category->id }})">
                        <i class="fa-solid fa-trash"></i>
                      </button>
                    </form>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center text-secondary py-3">
                  No hay categorías registradas.
                </td>
              </tr>
            @endforelse
            </tbody>
          </table>
        </div>
      </div>

    </div>
    <div class="mt-4 d-flex justify-content-end">
      {{ $categories->links('pagination::bootstrap-5') }}
    </div>
  </section>

  {{-- Confirmación para eliminar --}}
  <script>
    function confirmDelete(id) {
      Swal.fire({
        title: '¿Eliminar categoría?',
        text: 'Esta acción no se puede deshacer.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#00C4B3',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        background: '#0b1c2b',
        color: '#ffffff'
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

