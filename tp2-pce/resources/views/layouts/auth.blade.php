<!DOCTYPE html>
<html lang="es">
<head>
  @include('partials.head')
</head>
<body>


<main class="bg-gradient-dark text-light">
  {{ $slot ?? '' }}
  @yield('content')
</main>


@include('partials.scripts')

</body>
</html>
