@extends('layouts.app')

@section('title', 'Servicio')

@section('content')

  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container">
      <div class="row align-items-center g-4">
        <div class="col-12">
          <h1 class="fs-1 font-bankgothic fw-bold mb-2">
            Servicios a Medida Para Tu Éxito Digital
          </h1>
          <p class="text-blanco mb-4">
            Elegí el alcance que mejor te calza: sitio institucional, landing,
            CMS, formularios, SEO y mantenimiento.
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="py-4">
    <div class="container">
      <div class="mb-4">
        <h2 class="fs-2 font-bankgothic fw-bold">Servicios</h2>
        <p class="text-gris mb-0">Servicios clave para tu presencia digital.</p>
      </div>

      <div class="row g-4">
        @foreach($services as $service)
          <x-service-card
            image="{{asset('storage/img/services/' . $service->image)}}"
            alt="Mockup de un sitio institucional"
            title="{{ $service->name}}"
            description="{{ $service->subtitle}}"
            price="${{ number_format($service->plans->first()->price, 0, ',', '.') }} dolares"
            link="{{ route('pages.viewService', $service) }}"
          />
        @endforeach
      </div>
    </div>
  </section>

@endsection
