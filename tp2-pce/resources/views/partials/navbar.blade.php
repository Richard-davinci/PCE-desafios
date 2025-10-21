<nav class="navbar navbar-expand-lg navbar-dark bg-gradient-dark border-bottom fixed-top">
  <div class="container">
    <a class="navbar-brand d-flex justify-content-center justify-content-lg-start align-items-center m-auto"
       href="{{ route('pages.home') }}">
      <img src="{{ asset('img/logo.png') }}" alt="logo Lili Studio" class="img-fluid w-75">
    </a>

    <button class="navbar-toggler toogler-color" type="button" data-bs-toggle="collapse"
            data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Abrir menú">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div id="mainNav" class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto font-bankgothic align-items-end align-items-lg-center gap-0 gap-lg-2">

        <li class="nav-item text-center">
          <x-nav-link route="pages.home">Inicio</x-nav-link>
        </li>
        <li class="nav-item text-center">
          <x-nav-link route="pages.about">Nosotros</x-nav-link>
        </li>
        <li class="nav-item text-center">
          <x-nav-link route="pages.service">Servicios</x-nav-link>
        </li>
        <li class="nav-item text-center">
          <x-nav-link route="pages.contact">Contacto</x-nav-link>
        </li>
        @guest
        <!-- Acciones -->
        <li class="nav-item text-center">
          <a class="btn btn-outline-turquesa ms-0 ms-lg-2 w-100 w-lg-auto mt-2 mt-lg-0"
             href="{{ route('login') }}">
            Iniciar Sesión
          </a>
        </li>
        {{--<li class="nav-item text-center">
          <a class="btn btn-turquesa ms-0 ms-lg-2 w-100 w-lg-auto mt-2 mt-lg-0"
             href="{{ route('register') }}">
            Registrarse
          </a>
        </li>--}}
        @endguest

        <!-- Usuario -->
        @auth
          <li class="nav-item dropdown ms-lg-2">
            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 text-light justify-content-center"
               href="#" data-bs-toggle="dropdown">
              <img src="{{ asset('img/ricardo.webp') }}" alt="Avatar de usuario" class="navbar-avatar">
              <span id="navUserName">Mi cuenta</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark shadow border-light">
              <li>
                <a class="dropdown-item" href="{{ route('user.myProfile') }}">
                  <i class="bi bi-person-circle me-2"></i> Ver perfil
                </a>
              </li>
              <li>
                <form action="{{ route('logout') }}" type="post">
                  @csrf
                  <button type="submit" class="dropdown-item text-danger">
                    <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
                  </button>
                </form>
              </li>
            </ul>
          </li>
        @endauth

      </ul>
    </div>
  </div>
</nav>

