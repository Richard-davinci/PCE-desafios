@extends('layouts.app')

@section('title', 'Listado de usuarios')

@section('content')

  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container">
      <h1 class="fs-1 font-bankgothic fw-bold mb-1">Usuarios</h1>
      <div class="my-2 d-flex flex-wrap justify-content-between align-items-center gap-2">
        <p class="text-secondary mb-0">Listado general de usuarios registrados en el sistema.</p>
        <div class="d-flex gap-2">
          <a href="{{ route('admin.users.create') }}" class="btn btn-turquesa">
            <i class="bi bi-plus-circle me-2"></i>Nuevo usuario
          </a>
        </div>
      </div>
    </div>
  </section>

  <section class="container py-5">
    {{-- Mensajes de éxito --}}
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    {{-- Mensajes de error opcionales --}}
    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    {{-- Filtros --}}
    <div class="bg-azul rounded shadow-sm mb-3">
      <button class="btn btn-azul text-white w-100 text-start rounded-lg py-4 fs-5"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#filtrosUsuarios"
              aria-expanded="false"
              aria-controls="filtrosUsuarios">
        <i class="bi bi-funnel me-2"></i>Filtros de búsqueda
      </button>

      <div class="collapse" id="filtrosUsuarios">
        <div class="p-3 border-top border-light bg-azul-light rounded-bottom">
          <form method="GET" action="{{ route('admin.users.index') }}" class="row g-2">
            <div class="col-md-3">
              <label for="name" class="mb-1">Nombre: </label>
              <input type="text"
                     name="name"
                     class="form-control"
                     placeholder="Ingrese un nombre"
                     value="{{ request('name') }}">
            </div>

            <div class="col-md-3">
              <label for="email" class="mb-1">Email: </label>
              <input type="email"
                     name="email"
                     class="form-control"
                     placeholder="Ingrese un mail"
                     value="{{ request('email') }}">
            </div>

            <div class="col-md-3">
              <label for="role" class="mb-1">Roles: </label>

              <select name="role" class="form-select">
                <option value="">Todos los roles</option>
                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
              </select>
            </div>

            <div class="col-12">
              <div class="d-flex justify-content-end gap-2 mt-2">
                <button type="submit" class="btn btn-turquesa">
                  <i class="bi bi-filter"></i> Filtrar
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-turquesa">
                  <i class="bi bi-x-circle"></i> Limpiar
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    {{-- Tabla de usuarios --}}
    <div class="shadow-sm p-3 bg-azul rounded-2">
      <h2 class="font-bankgothic fs-3"> Listado de usuarios</h2>
      <div class="card border-light border-2 shadow-sm">
        <div class="table-responsive">
          <table class="table table-striped align-middle mb-0">
            <thead>
            <tr class="table-dark font-bankgothic">
              <th class="text-center">#</th>
              <th>Nombre</th>
              <th>Email</th>
              <th class="text-center">Rol</th>
              <th class="text-center">Suscripciones</th>
              <th class="text-center">Registrado</th>
              <th class="text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
              <tr>
                <td class="text-center">{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td class="text-secondary">{{ $user->email }}</td>
                {{-- Rol --}}
                <td class="text-center">
                  @if($user->role === 'admin')
                    <span class="badge bg-turquesa">Admin</span>
                  @else
                    <span class="badge bg-azul">User</span>
                  @endif
                </td>
                <td class="text-center">
                  <span class="badge bg-turquesa me-2">
                    {{ $user->active_subscriptions_count }}
                  </span>activas
                </td>

                <td class="text-center small">
                  {{ optional($user->created_at)->format('d/m/Y') }}
                </td>

                {{-- Acciones --}}
                <td class="text-end">
                  <div class="d-flex flex-wrap justify-content-center gap-2">
                    {{--ver usuario--}}
                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-azul ">
                      <i class="fa-regular fa-eye me-1"></i>
                    </a>
                    {{-- Editar --}}
                    <a href="{{ route('admin.users.edit', $user) }}"
                       class="btn  btn-azul"
                       title="Editar usuario">
                      <i class="fa-solid fa-pen"></i>
                    </a>

                    {{-- Resetear contraseña --}}
                    <form id="resetPassForm{{ $user->id }}"
                          action="{{ route('admin.users.reset-password', $user) }}"
                          method="POST"
                          class="d-inline">
                      @csrf
                      @method('PATCH')

                      <button type="button"
                              class="btn btn-azul"
                              title="Forzar cambio de contraseña"
                              onclick="confirmResetPassword({{ $user->id }})">
                        <i class="bi bi-key-fill"></i>
                      </button>
                    </form>


                    {{-- Eliminar usuario --}}
                    <form id="deleteUserForm{{ $user->id }}"
                          action="{{ route('admin.users.destroy', $user->id) }}"
                          method="POST"
                          class="d-inline">
                      @csrf
                      @method('DELETE')

                      <button type="button"
                              id="deleteUserBtn{{ $user->id }}"
                              class="btn  btn-danger"
                              title="Eliminar usuario"
                              data-role="{{ $user->role }}"
                              data-has-subs="{{ $user->subscriptions_count > 0 ? '1' : '0' }}"
                              onclick="confirmDeleteUser({{ $user->id }})">
                        <i class="fa-solid fa-trash"></i>
                      </button>
                    </form>

                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center text-secondary py-4">
                  No hay usuarios registrados.
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
      {{ $users->links('pagination::bootstrap-5') }}
    </div>

  </section>

  <script>
    function confirmDeleteUser(id) {
      const btn = document.getElementById(`deleteUserBtn${id}`);
      if (!btn) return;

      const role = btn.dataset.role;
      const tieneSubs = btn.dataset.hasSubs === '1';

      // bloquear si tiene suscripciones
      if (tieneSubs) {
        Swal.fire({
          title: 'No se puede eliminar',
          text: 'Este usuario tiene suscripciones activas. Primero gestioná o cancelá esas suscripciones.',
          icon: 'warning',
          confirmButtonText: 'Entendido',
          background: '#112b3a',
          color: '#cfd6dc',
          customClass: {
            popup: 'swal-custom-popup',
            title: 'swal-custom-title',
            confirmButton: 'swal-custom-confirm',
          },
        });
        return;
      }

      // Confirmación
      Swal.fire({
        title: '¿Eliminar usuario?',
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
          const form = document.getElementById(`deleteUserForm${id}`);
          if (form) {
            form.submit();
          }
        }
      });
    }

    function confirmResetPassword(id) {
      Swal.fire({
        title: '¿Resetear contraseña?',
        text: 'El usuario deberá generar una nueva contraseña al iniciar sesión.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, resetear',
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
          const form = document.getElementById(`resetPassForm${id}`);
          if (form) {
            form.submit();
          }
        }
      });
    }
  </script>

@endsection
