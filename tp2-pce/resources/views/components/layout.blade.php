<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? '' }} :: Lili Studio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/style.css') }}" rel="stylesheet">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-gradient-dark border-bottom fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex justify-content-center justify-content-lg-start align-items-center m-auto"
               href="/">
                <img src="img/logo.png" alt="logo" class="img-fluid w-75">
            </a>

            <button class="navbar-toggler toogler-color" type="button" data-bs-toggle="collapse"
                    data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Abrir menú">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="mainNav" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto font-bankgothic align-items-end align-items-lg-center gap-0 gap-lg-2">
                    <li class="nav-item text-center">
                        <x-nav-link route="home">Inicio</x-nav-link>
                    <li class="nav-item text-center">
                        <x-nav-link route="about">Nosotros</x-nav-link>
                    </li>
                    <li class="nav-item text-center">
                        <x-nav-link route="service">Servicios</x-nav-link>
                    </li>
                    <li class="nav-item text-center">
                        <x-nav-link route="contact">Contacto</x-nav-link>
                    </li>

                    <!-- Acciones -->
                    <li class="nav-item text-center">
                        <a class="btn btn-outline-turquesa ms-0 ms-lg-2 w-100 w-lg-auto mt-2 mt-lg-0"
                           href="{{route('usuario.loginUser')}}">
                             Iniciar Sesión
                        </a>
                    </li>
                    <li class="nav-item text-center">
                        <a class="btn btn-turquesa ms-0 ms-lg-2 w-100 w-lg-auto mt-2 mt-lg-0"
                           href="{{route('admin.login')}}">
                            <i class="bi bi-speedometer2"></i> Admin
                        </a>
                    </li>
                    <!-- Usuario -->
                    <li class="nav-item dropdown ms-lg-2">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 text-light justify-content-center"
                           href="#" data-bs-toggle="dropdown">
                            <img src="../img/ricardo.webp" alt="Avatar" class="navbar-avatar">
                            <span id="navUserName">Mi cuenta</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark shadow border-light">
                            <li>
                                <a class="dropdown-item" href="{{route('usuario.myProfile')}}">
                                    <i class="bi bi-person-circle me-2"></i> Ver perfil
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item text-danger" href="#" id="btnLogout">
                                    <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</header>
{{$slot}}
<!-- FOOTER -->
<footer class="py-4 bg-black border-top border-secondary">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-12 col-lg-4">
                <a class="navbar-brand d-flex justify-content-center justify-content-lg-start align-items-center m-auto"
                   href="{{route('home')}}">
                    <img src="img/logo.png" alt="logo" class="img-fluid w-50">
                </a>
            </div>
            <div class="col-12 col-lg-8">
                <ul
                    class="list-unstyled mb-0 text-blanco d-flex flex-column flex-md-row align-items-center justify-content-md-end gap-3 small">
                    <li><i class="bi bi-person me-1 text-accent"></i> Ricardo Rodolfo Garcia</li>
                    <li><i class="bi bi-calendar3 me-1 text-accent"></i> 37 años</li>
                    <li><i class="bi bi-envelope me-1 text-accent"></i>
                        <a class="link-light link-underline-opacity-0" href="mailto:ricardo.garcia@davinci.edu.ar">ricardo.garcia@davinci.edu.ar</a>
                    </li>
                    <li><i class="bi bi-instagram me-1 text-accent"></i>
                        <a class="link-light link-underline-opacity-0" href="https://www.instagram.com/lilitech_laplata"
                           target="_blank" rel="noopener">@lilitech_laplata</a>
                    </li>
                    <li><i class="bi bi-globe2 me-1 text-accent"></i>
                        <a class="link-light link-underline-opacity-0" href="https://lilitech.shop/" target="_blank"
                           rel="noopener">lilitech.shop</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>
</html>
