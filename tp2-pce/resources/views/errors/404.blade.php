@extends('layouts.app')

@section('title', 'Error 404')

@section('content')
  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container">
      <h1 class="fs-1 font-bankgothic fw-bold mb-1">Error 404</h1>
      <p class="text-secondary mb-0">La página que buscas no se encuentra disponible o no existe.</p>
      <a href="{{ route('pages.index') }}" class="btn btn-turquesa mt-3">Volver al inicio</a>
    </div>
  </section>
@endsection
