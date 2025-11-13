@extends('layouts.auth')

@section('title', 'No autorizado')

@section('content')
  <section class="error-wrapper bg-gradient-dark text-light">

    <div class="error-card">
      <div class="mb-3">
        <i class="fa-solid fa-shield-halved error-icon"></i>
      </div>
      <h1 class="fs-1 font-bankgothic text-turquesa mb-3">
        Acceso no autorizado
      </h1>
      <p class="fs-6 text-blanco mb-4">
        No tenés permisos para ver esta sección o realizar esta acción.
      </p>

      <a href="{{ route('pages.index') }}"
         class="btn btn-turquesa ">
        Volver al inicio
      </a>

    </div>

  </section>

@endsection
