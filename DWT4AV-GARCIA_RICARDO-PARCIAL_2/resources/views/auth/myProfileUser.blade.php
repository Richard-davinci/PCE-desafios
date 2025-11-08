@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container" style="max-width: 600px;">
      <h1 class="font-bankgothic fw-bold mb-4">Editar mi perfil</h1>

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
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

      <form action="{{ route('profile.update') }}" method="POST" class="row g-3">
        @csrf
        @method('PUT')

        <div class="col-12">
          <label for="name" class="form-label">Nombre</label>
          <input type="text" id="name" name="name" class="form-control bg-dark text-light border-secondary"
                 value="{{ old('name', Auth::user()->name) }}" required>
        </div>

        <div class="col-12">
          <label for="email" class="form-label">Correo electrónico</label>
          <input type="email" id="email" name="email" class="form-control bg-dark text-light border-secondary"
                 value="{{ old('email', Auth::user()->email) }}" required>
        </div>

        <div class="col-12">
          <label for="password" class="form-label">Nueva contraseña (opcional)</label>
          <div class="input-group">
            <input type="password" id="password" name="password"
                   class="form-control bg-dark text-light border-secondary">
            <button type="button" class="btn btn-outline-secondary" id="togglePassUser" tabindex="-1">
              <i class="bi bi-eye"></i>
            </button>
          </div>
        </div>

        <div class="col-12">
          <label for="password_confirmation" class="form-label">Confirmar nueva contraseña</label>
          <input type="password" id="password_confirmation" name="password_confirmation"
                 class="form-control bg-dark text-light border-secondary">
        </div>

        <div class="col-12 d-grid d-sm-flex gap-3">
          <button type="submit" class="btn btn-turquesa font-bankgothic">Guardar cambios</button>
          <a href="{{ route('pages.index') }}" class="btn btn-outline-light font-bankgothic">Volver</a>
        </div>
      </form>
    </div>
  </section>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const toggleBtn = document.querySelector('#togglePassUser');
      const passInput = document.querySelector('#password');
      if (toggleBtn && passInput) {
        toggleBtn.addEventListener('click', () => {
          const isHidden = passInput.type === 'password';
          passInput.type = isHidden ? 'text' : 'password';
          toggleBtn.innerHTML = isHidden
            ? '<i class="bi bi-eye-slash"></i>'
            : '<i class="bi bi-eye"></i>';
        });
      }
    });
  </script>
@endsection
