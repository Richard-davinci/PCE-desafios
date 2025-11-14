@props(['id','title','icon' => null,'action','method' => 'POST','name' => '', ])
<!--errores de validacion en modal categoria-->

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-light">
      <div class="modal-header bg-azul">
        <h5 class="modal-title font-bankgothic" id="{{ $id }}Label">
          @if ($icon)
            <i class=" {{ $icon }} me-2"></i>
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
          <div class="card  rounded-2 bg-azul">
            <div class="card-body">
              {{--texto del titulo del input nombre del modal categoría--}}
              <label class="form-label" for="categoriaInput{{ $id }}">Nombre de la categoría</label>
              <input type="text"
                     class="form-control @error('name') is-invalid @enderror"
                     id="categoriaInput{{ $id }}"
                     name="name"
                     value="{{ old('name', $name ?? '') }}"
                     placeholder="Nombre de la categoría">
              @error('name')
              <x-alert type="danger" :message="$message" small/>
              @enderror
            </div>
          </div>
        </div>
        <div class="modal-footer bg-azul">
          <button type="button" class="btn btn-outline-turquesa" data-bs-dismiss="modal"> <i class="fa-solid fa-xmark"></i> Cancelar</button>
          <button type="submit" class="btn btn-turquesa font-bankgothic"><i class="fa-solid fa-floppy-disk"></i>Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
