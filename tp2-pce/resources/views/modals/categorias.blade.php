<div class="modal fade" id="modalCategorias" tabindex="-1" aria-labelledby="modalCategoriasTitle"
     aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content border-light">
      <div class="modal-header  bg-azul">
        <h2 class="modal-title fs-3 font-bankgothic" id="modalCategoriasTitle">
          <i class="bi bi-tags me-1"></i>Categorías
        </h2>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <div class="card shadow-sm rounded-2 bg-azul  mt-3">
          <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST">
              @csrf
              <label class="form-label" for="newCat">Agregar categoría</label>
              <div class="input-group">
                <input id="newCat" class="form-control" placeholder="p.ej. Marketing">
                <button id="btnAgregarCategoria" class="btn btn-turquesa font-bankgothic" type="button">Agregar</button>
              </div>
            </form>
          </div>
        </div>
        <div class="shadow-sm p-3 bg-azul  rounded-2 my-3">
          <div class="card border-light border-2 shadow-sm">
            <div class="table-responsive">
              <table class="table table-striped align-middle mb-0">
                <thead>
                <tr class="table-dark font-bankgothic">
                  <th>#</th>
                  <th>Nombre de la categoría</th>
                  <th class="text-center">Cantidad de servicios</th>
                  <th class="text-end">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($categories as $category)
                  <tr>
                    <td>{{ $category->id }}</td>
                    <td><span class="nombre-categoria">{{ $category->name }}</span></td>
                    <td class="text-center">
                      <span class="badge text-bg-secondary">
                        {{ $category->services_count ?? 0 }}
                      </span>
                    </td>
                    <td class="text-center">
                      <div class="d-flex justify-content-center gap-2">

                        {{-- Editar --}}
                        <form action="{{ route('categories.update', $category->id) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <input name="name" value="{{ $category->name }}" required>
                          <button type="submit" class="btn btn-turquesa" title="Guardar">
                            <i class="bi bi-check"></i>
                          </button>
                        </form>

                        {{-- Eliminar --}}
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                              style="display:inline-block;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger" title="Eliminar">
                            <i class="bi bi-trash"></i>
                          </button>
                        </form>
                      </div>
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
        </div>


      </div>
      <div class="modal-footer bg-azul px-3">
        <button class="btn btn-turquesa font-bankgothic" data-bs-dismiss="modal" type="button">Cerrar
        </button>

      </div>
    </div>
  </div>
</div>

@if($errors->any())
  <div class="alert alert-danger">
    {{ implode('', $errors->all(':message')) }}
  </div>
@endif

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif
