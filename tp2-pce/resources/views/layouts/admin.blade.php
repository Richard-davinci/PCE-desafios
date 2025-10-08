<!DOCTYPE html>
<html lang="es">
<head>
    @include('partials.head')
</head>
<body>

@include('partials.navbarAdmin')

<main class="mt-5">
    {{ $slot ?? '' }}
    @yield('content')
</main>

@include('partials.footer')

@include('partials.scripts')

</body>
</html>
