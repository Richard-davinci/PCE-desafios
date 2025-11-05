@props([
    'id', // Ej: 'modalAgregarCategoria' o 'modalEditarCategoria1'
    'title', // Ej: 'Agregar Categoría' o 'Editar Categoría'
    'icon' => null, // Ej: 'bi-plus-circle' o 'bi-pencil', opcional
    'action', // Ruta para el form
    'method' => 'POST', // 'POST' o 'PUT'
    'name' => '', // Valor por defecto para el campo name
])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-light">
      <div class="modal-header bg-azul">
        <h5 class="modal-title font-bankgothic" id="{{ $id }}Label">
          @if ($icon)
            <i class="bi {{ $icon }} me-2"></i>
          @endif
          {{ $title }}
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ $action }}" method="POST">
        @csrf
        @if(strtoupper($method) === 'PUT')
          @method('PUT')
        @endif
        <div class="modal-body my-3">
          <div class="card shadow-sm rounded-2 bg-azul">
            <div class="card-body">
              <label class="form-label" for="categoriaInput{{ $id }}">Nombre de la categoría</label>
              <input type="text"
                     class="form-control"
                     id="categoriaInput{{ $id }}"
                     name="name"
                     value="{{ old('name', $name) }}"
                     placeholder="Nombre de la categoría"
                     required>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-azul">
          <button type="button" class="btn btn-outline-turquesa" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-turquesa font-bankgothic">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
