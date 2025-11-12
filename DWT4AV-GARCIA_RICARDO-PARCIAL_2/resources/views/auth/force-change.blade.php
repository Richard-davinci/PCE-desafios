@extends('layouts.auth')

@section('title', 'Actualizar contraseña')

@section('content')
  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container" style="max-width:500px">
      <h1 class="fs-3 font-bankgothic fw-bold mb-3">Actualizá tu contraseña</h1>
      <p class="text-secondary mb-4">
        Por seguridad, debés cambiar tu contraseña antes de continuar.
      </p>

      @if(session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
      @endif

      @if($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('force.update') }}" method="POST" class="row g-3">
        @csrf

        <div class="col-12">
          <label for="current_password" class="form-label">Contraseña actual</label>
          <div class="input-group">
          <input type="password" id="current_password" name="current_password"
                   class="form-control bg-dark text-light border-secondary" required>
            <button type="button" class="btn btn-outline-turquesa" id="toggleCurrentPass"
                    data-toggle-password data-target="#current_password" tabindex="-1">
            <i class="bi bi-eye"></i>
            </button>
          </div>
        </div>

        <div class="col-12">
          <label for="password" class="form-label">Nueva contraseña</label>
          <div class="input-group">
            <input type="password" id="password" name="password"
                   class="form-control bg-dark text-light border-secondary">
            <button type="button" class="btn btn-outline-turquesa" id="togglePassReg2" tabindex="-1">
              <i class="bi bi-eye"></i>
            </button>
          </div>
        </div>

        <div class="col-12">
          <label for="password_confirmation" class="form-label">Confirmar nueva contraseña</label>
          <div class="input-group">
            <input type="password" id="password_confirmation" name="password_confirmation"
                   class="form-control bg-dark text-light border-secondary">
            <button type="button" class="btn btn-outline-turquesa" id="togglePassReg2" tabindex="-1">
              <i class="bi bi-eye"></i>
            </button>
          </div>
        </div>

        <div class="col-12 d-grid">
          <button type="submit" class="btn btn-turquesa font-bankgothic">
            Guardar nueva contraseña
          </button>
        </div>
      </form>
    </div>
  </section>
@endsection
