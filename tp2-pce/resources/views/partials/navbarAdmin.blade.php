<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-gradient-dark border-bottom fixed-top">
    <div class="container-fluid">
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
            <x-nav-link route="admin.dashboard">Dashboard</x-nav-link>
          </li>
          <li class="nav-item text-center">
            <x-nav-link route="users.index">Usuarios</x-nav-link>
          </li>
          <li class="nav-item text-center">
            <x-nav-link route="services.index">Servicios</x-nav-link>
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
      </div>
    </div>
  </nav>
</header>
