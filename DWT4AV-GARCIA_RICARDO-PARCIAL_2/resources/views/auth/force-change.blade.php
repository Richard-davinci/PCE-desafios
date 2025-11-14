@extends('layouts.auth')

@section('title', 'Actualizar contraseña')

@section('content')
  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container" style="max-width:500px">
      <h1 class="fs-3 font-bankgothic fw-bold mb-3">Actualizá tu contraseña</h1>
      <p class="text-blanco mb-4">
        Por seguridad, debés cambiar tu contraseña antes de continuar.
      </p>

      <div class="tab-content bg-azul text-light border border-light rounded p-5 shadow-sm">
        <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
          <form class="row g-3" action="{{ route('force.update') }}" method="post" id="loginForm">
            @csrf
            <div class="col-12">
              <label for="current_password" class="form-label">Contraseña actual</label>
              <div class="input-group">
                <input type="password" id="current_password" name="current_password"
                       class="form-control" >
                <button type="button" class="btn btn-outline-turquesa"  tabindex="-1">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
              @error('current_password')
              <x-alert type="danger" :message="$message" small/>
              @enderror

            </div>

            <div class="col-12">
              <label for="password" class="form-label">Nueva contraseña</label>
              <div class="input-group">
                <input type="password" id="password" name="password"
                       class="form-control ">
                <button type="button" class="btn btn-outline-turquesa"  tabindex="-1">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
              <span class="small text-blanco">La contraseña debe tener al menos 6 caracteres</span>
              @error('password')
              <x-alert type="danger" :message="$message" small/>
              @enderror

            </div>

            <div class="col-12">
              <label for="password_confirmation" class="form-label">Confirmar nueva contraseña</label>
              <div class="input-group">
                <input type="password" id="password_confirmation" name="password_confirmation"
                       class="form-control">
                <button type="button" class="btn btn-outline-turquesa"  tabindex="-1">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
              @error('password_confirmation')
              <x-alert type="danger" :message="$message" small/>
              @enderror
            </div>

            <div class="col-12">
              <button type="submit" class="btn btn-turquesa font-bankgothic">
                Actualizar contraseña
              </button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </section>
@endsection
