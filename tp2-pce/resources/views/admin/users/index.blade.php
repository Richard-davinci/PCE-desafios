@extends('layouts.app')

@section('title', 'Listado de usuarios')

@section('content')

  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container">
      <h1 class="fs-1 font-bankgothic fw-bold mb-1">Listado de Usuarios</h1>
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
      <button class="btn btn-azul text-white w-100 text-start rounded-lg py-4"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#filtrosUsuarios"
              aria-expanded="false"
              aria-controls="filtrosUsuarios">
        <i class="bi bi-funnel me-2"></i>Filtros de búsqueda
      </button>

      <div class="collapse" id="filtrosUsuarios">
        <div class="p-3 border-top border-light bg-azul">
          <form method="GET" action="{{ route('admin.users.index') }}" class="row g-2">
            <div class="col-md-3">
              <input type="text"
                     name="name"
                     class="form-control"
                     placeholder="Nombre"
                     value="{{ request('name') }}">
            </div>

            <div class="col-md-3">
              <input type="email"
                     name="email"
                     class="form-control"
                     placeholder="Email"
                     value="{{ request('email') }}">
            </div>

            <div class="col-md-3">
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

    {{-- Tabla de usuarios (desktop) --}}
    <div class="shadow-sm p-3 bg-azul rounded-2 d-none d-lg-block">
      <div class="card border-light border-2 shadow-sm">
        <div class="table-responsive">
          <table class="table table-striped align-middle mb-0">
            <thead>
            <tr class="table-dark font-bankgothic">
              <th scope="col" class="text-center">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Email</th>
              <th scope="col" class="text-center">Rol</th>
              <th scope="col" class="text-center">Registrado</th>
              <th scope="col" class="text-center">Acciones</th>
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
                    <span class="badge bg-secondary">User</span>
                  @endif
                </td>

                {{-- Fecha de registro --}}
                <td class="text-center small">
                  {{ optional($user->created_at)->format('d/m/Y') }}
                </td>

                {{-- Acciones --}}
                <td class="text-center">
                  <div class="d-flex flex-wrap justify-content-center gap-2">

                    {{-- Editar --}}
                    <a href="{{ route('admin.users.edit', $user) }}"
                       class="btn btn-sm btn-azul"
                       title="Editar usuario">
                      <i class="fa-solid fa-pen"></i>
                    </a>

                    {{-- Resetear contraseña --}}
                    <form action="{{ route('admin.users.reset-password', $user) }}"
                          method="POST"
                          class="d-inline"
                          onsubmit="return confirm('¿Seguro que querés resetear la contraseña de este usuario?')">
                      @csrf
                      @method('PATCH')
                      <button type="submit" class="btn btn-sm btn-warning" title="Forzar cambio de contraseña">
                        <i class="bi bi-key-fill"></i>
                      </button>
                    </form>

                    {{-- Eliminar --}}
                    <form action="{{ route('admin.users.destroy', $user) }}"
                          method="POST"
                          class="d-inline"
                          onsubmit="return confirm('¿Seguro que querés eliminar este usuario?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                              class="btn btn-sm btn-danger"
                              title="Eliminar usuario">
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

    {{-- Versión mobile (opcional, siguiendo tu estilo, descomentás si la querés usar) --}}
    {{--
    <div class="d-block d-lg-none">
      <div class="row">
        @forelse($users as $user)
          <div class="col-12 mb-3">
            <div class="card shadow-sm bg-azul">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <div class="small mb-2">
                    <span class="text-turquesa">ID:</span> {{ $user->id }}
                  </div>
                  @if($user->status === 'activo')
                    <span class="badge bg-success text-light">Activo</span>
                  @elseif($user->status === 'inactivo')
                    <span class="badge bg-danger">Inactivo</span>
                  @else
                    <span class="badge bg-dark text-secondary">Sin definir</span>
                  @endif
                </div>

                <h5 class="card-title font-bankgothic text-turquesa mb-1">
                  {{ $user->name }}
                </h5>
                <div class="mb-1 small">
                  <span class="text-turquesa">Email:</span> {{ $user->email }}
                </div>
                <div class="mb-1 small">
                  <span class="text-turquesa">Rol:</span>
                  @if($user->role === 'admin')
                    Admin
                  @else
                    User
                  @endif
                </div>
                <div class="mb-2 small">
                  <span class="text-turquesa">Registrado:</span>
                  {{ optional($user->created_at)->format('d/m/Y') }}
                </div>

                <div class="d-flex justify-content-center gap-2 bg-light p-2 rounded-2">
                  <a href="{{ route('admin.users.edit', $user) }}"
                     class="btn btn-dark"
                     title="Editar">
                    <i class="bi bi-pencil"></i>
                  </a>

                  <form action="{{ route('admin.users.reset-password', $user) }}"
                        method="POST"
                        onsubmit="return confirm('¿Resetear contraseña?')"
                        style="display:inline-block;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-turquesa" title="Reset pass">
                      <i class="bi bi-key-fill"></i>
                    </button>
                  </form>

                  <form action="{{ route('admin.users.destroy', $user) }}"
                        method="POST"
                        onsubmit="return confirm('¿Eliminar usuario?')"
                        style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" title="Eliminar">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>

              </div>
            </div>
          </div>
        @empty
          <div class="col-12 text-center text-secondary py-4">
            No hay usuarios registrados.
          </div>
        @endforelse
      </div>
    </div>
    --}}

    {{-- Paginación --}}
    <div class="mt-4 d-flex justify-content-end">
      {{ $users->links('pagination::bootstrap-5') }}
    </div>

  </section>

@endsection
