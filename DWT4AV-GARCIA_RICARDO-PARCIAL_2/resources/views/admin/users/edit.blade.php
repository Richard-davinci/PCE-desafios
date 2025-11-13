@extends('layouts.app')

@section('title', 'Editar usuario')

@section('content')

  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container">
      <h1 class="fs-1 font-bankgothic fw-bold mb-1">Editar usuario</h1>
      <p class="text-secondary mb-0">
        Modificación de datos básicos, rol y estado del usuario seleccionado.
      </p>
    </div>
  </section>

  <section class="container py-5">

    {{-- Mensajes --}}
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">
        <i class="bi bi-exclamation-triangle me-2"></i>Revisá los datos ingresados.
      </div>
    @endif

    <div class="card bg-azul border-0 shadow-sm rounded-3">
      <div class="card-body p-4">
        <h2 class="font-bankgothic fs-3">Datos</h2>

        <form action="{{ route('admin.users.update', $user) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="row g-3">

            {{-- Nombre --}}
            <div class="col-md-6">
              <label for="name" class="form-label text-light">Nombre completo</label>
              <input type="text"
                     id="name"
                     name="name"
                     class="form-control @error('name') is-invalid @enderror"
                     value="{{ old('name', $user->name) }}"
                     required>
              @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Email --}}
            <div class="col-md-6">
              <label for="email" class="form-label text-light">Email</label>
              <input type="email"
                     id="email"
                     name="email"
                     class="form-control @error('email') is-invalid @enderror"
                     value="{{ old('email', $user->email) }}"
                     required>
              @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Rol --}}
            <div class="col-md-4">
              <label for="role" class="form-label text-light">Rol</label>
              <select id="role"
                      name="role"
                      class="form-select @error('role') is-invalid @enderror"
                      required>
                <option value="">Seleccione un rol</option>
                <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>

                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
              </select>
              @error('role')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Estado --}}
            <div class="col-md-4">
              <label for="status" class="form-label text-light">Estado</label>
              <select id="status"
                      name="status"
                      class="form-select @error('status') is-invalid @enderror">
                <option value="activo" {{ old('status', $user->status ?? 'activo') === 'activo' ? 'selected' : '' }}>
                  Activo
                </option>
                <option value="inactivo" {{ old('status', $user->status) === 'inactivo' ? 'selected' : '' }}>
                  Inactivo
                </option>
              </select>
              @error('status')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="d-flex justify-content-end gap-2 align-items-center mt-4">
              <a href="{{ route('admin.users.index') }}" class="btn btn-outline-turquesa">
                <i class="fa-solid fa-close me-1"></i>Cancelar
              </a>
              <button type="submit" class="btn btn-turquesa">
                <i class="fa-solid fa-floppy-disk me-1"></i>Guardar cambios
              </button>
          </div>
        </form>
      </div>
    </div>

  </section>

@endsection
