<nav class="navbar navbar-expand-lg navbar-dark bg-gradient-dark border-bottom fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand d-flex justify-content-center justify-content-lg-start align-items-center m-auto"
       href="{{ route('pages.index') }}">
      <img src="{{ asset('img/logo.png') }}" alt="logo Lili Studio" class="img-fluid w-75">
    </a>

    <button class="navbar-toggler toogler-color" type="button" data-bs-toggle="collapse"
            data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Abrir menú">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div id="mainNav" class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto font-bankgothic align-items-end align-items-lg-center gap-0 gap-lg-2 ">

        @php
          $user = Auth::user();

          $publicNavItems = [
            ['route' => 'pages.index',    'label' => 'Inicio'],
            ['route' => 'pages.about',    'label' => 'Nosotros'],
            ['route' => 'pages.services', 'label' => 'Servicios'],
            ['route' => 'pages.contact',  'label' => 'Contacto'],
          ];

          $adminNavItems = [
            ['route' => 'admin.dashboard',      'label' => 'Dashboard'],
            ['route' => 'admin.users.index',    'label' => 'Usuarios'],
            ['route' => 'admin.services.index', 'label' => 'Servicios'],
          ];
        @endphp

        {{-- ======================= USUARIOS AUTENTICADOS ======================= --}}
        @auth
          {{-- ADMIN --}}
          @if ($user->role === 'admin')
            @if (request()->is('admin/*'))
              {{-- ===== Dentro del panel Admin ===== --}}
              @foreach ($adminNavItems as $item)
                <li class="nav-item text-center">
                  <x-nav-link :route="$item['route']">
                    {{ $item['label'] }}
                  </x-nav-link>
                </li>
              @endforeach

              {{-- Botón para volver al sitio público --}}
              <li class="nav-item text-center">
                <a href="{{ route('pages.index') }}"
                   class="btn btn-outline-turquesa ms-0 ms-lg-2 w-100 w-lg-auto mt-2 mt-lg-0">
                  Ir a inicio
                </a>
              </li>
            @else
              {{-- En vistas públicas  --}}
              @foreach ($publicNavItems as $item)
                <li class="nav-item text-center">
                  <x-nav-link :route="$item['route']">
                    {{ $item['label'] }}
                  </x-nav-link>
                </li>
              @endforeach

              <li class="nav-item text-center">
                <a href="{{ route('admin.dashboard') }}"
                   class="btn btn-outline-turquesa ms-0 ms-lg-2 w-100 w-lg-auto mt-2 mt-lg-0">
                  Ir al Panel Admin
                </a>
              </li>
            @endif

            {{-- USUARIO NORMAL --}}
          @else
            @foreach ($publicNavItems as $item)
              <li class="nav-item text-center">
                <x-nav-link :route="$item['route']">
                  {{ $item['label'] }}
                </x-nav-link>
              </li>
            @endforeach
          @endif

          {{-- Dropdown de Mi Cuenta --}}
          <li class="nav-item dropdown ms-lg-2">
            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 justify-content-center"
               href="#" data-bs-toggle="dropdown">
              <img src="storage/{{ $user->profile_photo }}" alt="foto de {{$user->name}}" class="navbar-avatar">
              <span id="navUserName">Mi cuenta</span>
              <i class="fa-solid fa-caret-down ms-1"></i>
            </a>

            <ul class="dropdown-menu dropdown-menu-end custom-dropdown shadow">
              <li>
                <a class="dropdown-item" href="{{ route('user.myProfile') }}">
                  <i class="fa-solid fa-user me-2 text-turquesa"></i> Ver perfil
                </a>
              </li>
              @if ($user->role === 'user')
              <li>
                <a class="dropdown-item" href="{{ route('user.subscriptions') }}">
                  <i class="fa-solid fa-user me-2 text-turquesa"></i> Mis suscripciones
                </a>
              </li>
              @endif

              <li>
                <form action="{{ route('logout') }}" method="get">
                  @csrf
                  <button type="submit" class="dropdown-item text-danger">
                    <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Cerrar sesión
                  </button>
                </form>
              </li>
            </ul>
          </li>

          {{-- ======================= INVITADOS ======================= --}}
        @else
          @foreach ($publicNavItems as $item)
            <li class="nav-item text-center">
              <x-nav-link :route="$item['route']">
                {{ $item['label'] }}
              </x-nav-link>
            </li>
          @endforeach

          <li class="nav-item text-center">
            <a class="btn btn-outline-turquesa ms-0 ms-lg-2 w-100 w-lg-auto mt-2 mt-lg-0"
               href="{{ route('login') }}">
              Iniciar Sesión
            </a>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
