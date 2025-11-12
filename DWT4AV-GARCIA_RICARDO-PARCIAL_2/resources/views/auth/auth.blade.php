@extends('layouts.auth')

@section('title', 'Acceder')

@section('content')
  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container" style="max-width:500px">
      <div class="mb-4 text-center">
        <h1 class="fs-2 font-bankgothic fw-bold">Accedé a tu cuenta</h1>
        <p class="text-secondary mb-0">Iniciá sesión o registrate para gestionar tu suscripción.</p>
      </div>

      <ul class="nav tabs-underline justify-content-center mb-2" id="authTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active font-bankgothic fs-5" id="login-tab"
                  data-bs-toggle="tab" data-bs-target="#login" type="button"
                  role="tab" aria-controls="login" aria-selected="true">
            Iniciar Sesión
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link font-bankgothic fs-5" id="registro-tab"
                  data-bs-toggle="tab" data-bs-target="#registro" type="button"
                  role="tab" aria-controls="registro" aria-selected="false">
            Registrate
          </button>
        </li>
      </ul>
      @if($errors->any())
        <x-alert type="danger" message="las credenciales no coinciden"/>
      @endif

      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      <div class="tab-content bg-azul text-light border border-light rounded p-5 shadow-sm">
        <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
          <form class="row g-3" action="{{route('login.store')}}" method="post" id="loginForm">
            @csrf
            <div class="col-12">
              <label for="emailLogin" class="formd-label">Email</label>
              <input type="email" id="emailLogin" class="form-control" name="email" value="{{ old('email') }}">
              @error('email')
              <x-alert type="danger" :message="$message" small/>
              @enderror
            </div>

            <div class="col-12">
              <label for="passLogin" class="form-label">Contraseña</label>
              <div class="input-group">
                <input type="password" id="passLogin" class="form-control" name="password">
                <button type="button" class="btn btn-outline-turquesa"  id="togglePassLogin"
                        data-target="#passLogin" tabindex="-1">
                  <i class="fa-solid fa-eye"></i>
                </button>
              </div>
              @error('password')
              <x-alert type="danger" :message="$message" small/>
              @enderror
            </div>

            {{--no funciona todavia el recordar averiguar como--}}
            <div class="col-12 mt-2">
              <a href="#" class="text-decoration-none text-turquesa small">
                Me olvidé la contraseña
              </a>
            </div>

            <div class="col-12">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Recordarme</label>
              </div>
            </div>

            <div class="col-md-6 ">
              <a href="{{route('pages.index')}}" type="button" class="btn btn-outline-turquesa font-bankgothic w-100">
                <i class="fa-solid fa-arrow-left me-1"></i> Volver
              </a>
            </div>
            <div class="col-md-6  ">
              <button class="btn btn-turquesa font-bankgothic w-100" type="submit">Ingresar</button>
            </div>
          </form>
        </div>

        <div class="tab-pane fade" id="registro" role="tabpanel" aria-labelledby="registro-tab">
          <form class="row g-3 " id="registerForm" action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="col-md-12">
              <label for="nombreReg" class="form-label">Nombre y apellido</label>
              <input type="text" id="nombreReg" name="name" class="form-control" value="{{ old('name') }}">
              @error('name')
              <x-alert type="danger" :message="$message" small/>
              @enderror
            </div>

            <div class="col-12">
              <label for="emailReg" class="form-label">Email</label>
              <input type="email" id="emailReg" name="email" class="form-control" value="{{ old('email') }}">
              @error('email')
              <x-alert type="danger" :message="$message" small/>
              @enderror
            </div>

            <div class="col-md-6">
              <label for="passReg" class="form-label">Contraseña</label>
              <div class="input-group">
                <input type="password" id="passReg" name="password" class="form-control"
                       value="{{ old('password') }}">
                <button type="button" class="btn btn-outline-turquesa" id="togglePassReg" tabindex="-1">
                  <i class="fa-solid fa-eye"></i>
                </button>
              </div>
              @error('password')
              <x-alert type="danger" :message="$message" small/>
              @enderror
            </div>

            <div class="col-md-6">
              <label for="passReg2" class="form-label">Repetir contraseña</label>
              <div class="input-group">
                <input type="password" id="passReg2" name="password_confirmation" class="form-control"
                       value="{{ old('password_confirmation') }}">
                <button type="button" class="btn btn-outline-turquesa" id="togglePassReg2" tabindex="-1">
                  <i class="fa-solid fa-eye"></i>
                </button>
              </div>
              @error('password_confirmation')
              <x-alert type="danger" :message="$message" small/>
              @enderror
            </div>
            <div class="col-md-6">
              <button type="button" class="btn btn-outline-turquesa font-bankgothic w-100 mt-4">
                <i class="fa-solid fa-arrow-left me-1"></i> Volver
              </button>
            </div>
            <div class="col-md-6">
              <button class="btn btn-turquesa font-bankgothic w-100 mt-4" type="submit">Crear cuenta</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const tabs = {
        login: document.querySelector('#login-tab'),
        registro: document.querySelector('#registro-tab'),
      };

      function activateAuthTab(key) {
        const trigger = tabs[key];
        if (!trigger) return;

        const tab = new bootstrap.Tab(trigger);
        tab.show();
      }

      // Tab inicial según backend (por defecto login)
      const initialTab = @json(session('auth_tab', 'login'));
      activateAuthTab(initialTab);

      document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', () => {
          const targetId = btn.getAttribute('data-target');
          const input = document.getElementById(targetId);
          if (!input) return;

          const isPwd = input.type === 'password';
          input.type = isPwd ? 'text' : 'password';

          const icon = btn.querySelector('i');
          if (icon) {
            icon.classList.toggle('fa-eye', !isPwd);
            icon.classList.toggle('fa-eye-slash', isPwd);
          }
        });
    });
  </script>

@endsection
