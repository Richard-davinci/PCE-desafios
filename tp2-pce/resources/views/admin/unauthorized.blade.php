@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container">
      <h1 class="fs-1 font-bankgothic fw-bold mb-1">Acceso no autorizado</h1>
      <p class="text-secondary mb-0">No tenés permisos suficientes para acceder a esta página.</p>
      <a href="{{ route('pages.home') }}" class="btn btn-turquesa mt-3">Volver al inicio</a>
    </div>
  </section>
@endsection
