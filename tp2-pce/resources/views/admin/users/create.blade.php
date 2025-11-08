@extends('layouts.app')

@section('title', 'Crear usuario')

@section('content')

  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container">
      <h1 class="fs-1 font-bankgothic fw-bold mb-1">Crear nuevo usuario</h1>
      <p class="text-secondary mb-0">Alta de usuario con rol y estado dentro del sistema.</p>
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

    {{-- Errores de validación --}}
    @if($errors->any())
      <div class="alert alert-danger">
        <i class="bi bi-exclamation-triangle me-2"></i>Revisá los datos ingresados.
      </div>
    @endif

    <div class="card bg-azul border-0 shadow-sm rounded-3">
      <div class="card-body p-4">

        <form action="{{ route('admin.users.store') }}" method="POST">
          @csrf

          <div class="row g-3">

            {{-- Nombre --}}
            <div class="col-md-6">
              <label for="name" class="form-label text-light">Nombre completo</label>
              <input type="text"
                     id="name"
                     name="name"
                     class="form-control @error('name') is-invalid @enderror"
                     value="{{ old('name') }}"
                     placeholder="Nombre y apellido"
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
                     value="{{ old('email') }}"
                     placeholder="correo@ejemplo.com"
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
                <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
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
                <option value="activo" {{ old('status', 'activo') === 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ old('status') === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
              </select>
              @error('status')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Password opcional --}}
            <div class="col-md-4">
              <label for="password" class="form-label text-light">
                Contraseña
                <span class="text-secondary small d-block">
                  (Opcional: si la dejás vacía, se genera una automática)
                </span>
              </label>
              <input type="text"
                     id="password"
                     name="password"
                     class="form-control @error('password') is-invalid @enderror"
                     placeholder="Definir contraseña manual (opcional)">
              @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

          </div>

          <div class="d-flex justify-content-end align-items-center gap-2 mt-4">
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-turquesa">
             cancelar
            </a>
            <button type="submit" class="btn btn-turquesa">
              <i class="bi bi-check-circle me-1"></i>Guardar usuario
            </button>
          </div>

        </form>
      </div>
    </div>
  </section>

@endsection
