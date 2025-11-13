@extends('layouts.auth')

@section('title', 'Error 404')

@section('content')
  <section class="error-wrapper bg-gradient-dark text-light">

    <div class="error-card">

      <div class="mb-3">
        <i class="fa-solid fa-triangle-exclamation error-icon"></i>
      </div>

      <h1 class="fs-1 text-turquesa font-bankgothic mb-3">Error 404</h1>

      <p class="fs-6 text-blanco mb-4">
        La página que buscás no se encuentra disponible o no existe.
      </p>

      <a href="{{ route('pages.index') }}"
         class="btn btn-turquesa">
        Volver al inicio
      </a>

    </div>

  </section>


@endsection
