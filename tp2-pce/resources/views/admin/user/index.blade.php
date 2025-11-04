@extends('layouts.app')

@section('title', 'Listado de usuarios')

@section('content')
  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container">
      <h1 class="fs-1 font-bankgothic fw-bold mb-1">Listado de Usuarios</h1>
      <div class="my-2 d-flex flex-wrap justify-content-between align-items-center gap-2">
        <p class="text-secondary mb-0">Listado general de usuarios registrados en el sistema.</p>
        {{-- <div class="d-flex gap-2">
             <a href="{{ route('users.create') }}" class="btn btn-turquesa">
               <i class="bi bi-plus-circle me-2"></i>Nuevo usuario
             </a>
         </div>--}}
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

    {{--<div class="bg-azul rounded shadow-sm mb-3">
      <button class="btn btn-azul text-white w-100 text-start rounded-lg py-4" type="button" data-bs-toggle="collapse"
              data-bs-target="#filtrosUsuarios" aria-expanded="false" aria-controls="filtrosUsuarios">
        <i class="bi bi-funnel me-2"></i>Filtros de búsqueda
      </button>
      <div class="collapse" id="filtrosUsuarios">
        <div class="p-3 border-top border-light bg-azul">
          <form method="GET" action="{{ route('users.index') }}" class="row g-2">
            <div class="col-md-4">
              <input type="text" name="name" value="{{ request('name') }}" class="form-control" placeholder="Buscar por nombre">
            </div>
            <div class="col-md-4">
              <input type="text" name="email" value="{{ request('email') }}" class="form-control" placeholder="Buscar por email">
            </div>
            <div class="col-md-4">
              <select name="role" class="form-select">
                <option value="">Todos los roles</option>
                @foreach ($roles as $role)
                  <option value="{{ $role }}" @selected(request('role') === $role)>{{ ucfirst($role) }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-12">
              <div class="d-flex justify-content-end gap-2 mt-2">
                <button type="submit" class="btn btn-turquesa"><i class="bi bi-filter"></i> Filtrar</button>
                <a href="{{ route('users.index') }}" class="btn btn-turquesa"><i class="bi bi-x-circle"></i> Limpiar</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>--}}

    {{-- Tabla de usuarios --}}
    <div class="shadow-sm p-3 bg-azul rounded-2">
      <div class="card border-light border-2 shadow-sm">
        <div class="table-responsive">
          <table class="table table-striped align-middle mb-0">
            <thead>
            <tr class="table-dark font-bankgothic">
              <th class="text-center">#</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Rol</th>
              <th class="text-center">Creado</th>
              <th class="text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($users as $user)
              <tr>
                <td class="text-center">{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                  <span
                    class="badge {{ $user->role === 'admin' ? 'bg-turquesa' : 'bg-azul' }} text-uppercase">{{ $user->role }}</span>
                </td>
                <td class="text-center text-secondary small">{{ $user->created_at?->format('d/m/Y H:i') }}</td>
                <td class="text-center">
                  <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-dark" title="Ver">
                      <i class="bi bi-eye"></i>
                    </a>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-turquesa" title="Editar">
                      <i class="bi bi-pencil"></i>
                    </a>
                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                          onsubmit="return confirm('¿Eliminar este usuario?');" style="display:inline-block;">
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
                <td colspan="6" class="text-center text-secondary py-4">No hay usuarios para mostrar.</td>
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
@endsection
