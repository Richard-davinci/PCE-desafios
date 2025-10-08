<!DOCTYPE html>
<html lang="es">
<head>
    @include('partials.head')
</head>
<body>

@include('partials.navbar')

<main class="mt-5 pt-5">
    {{ $slot ?? '' }}
    @yield('content')
</main>

@include('partials.footer')

@include('partials.scripts')

</body>
</html>
