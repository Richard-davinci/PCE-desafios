@extends('layouts.app')

@section('title', 'Contacto')

@section('content')

  <section class="mt-3 py-5 bg-gradient-dark text-light">
    <div class="container">
      <h1 class="fs-1 fw-bold font-bankgothic mb-3">Ponete en contacto</h1>
      <p class="text-blanco">Estamos para ayudarte a hacer crecer tu proyecto digital</p>
    </div>
  </section>

  <section class=" py-4 container">
    <div class="row g-4">
      <div class="col-md-6">
        <div class="card bg-azul text-light border-light h-100">
          <div class="card-body">
            <h3 class="fs-3 font-bankgothic fw-bold mb-3">Escribinos</h3>
            <form id="formulario" action="#" method="POST">
              <div class="row g-3">
                <div class="col-md-6">
                  <label for="nombre" class="form-label">Nombre y apellido</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" required aria-required="true">
                  <div class="invalid-feedback">Ingresá tu nombre.</div>
                </div>
                <div class="col-md-6">
                  <label for="email" class="form-label">Email de contacto</label>
                  <input type="email" class="form-control" id="email" name="email" required aria-required="true">
                  <div class="invalid-feedback">Ingresá un email válido.</div>
                </div>
                <div class="col-12">
                  <label for="asunto" class="form-label">Asunto</label>
                  <input type="text" class="form-control" id="asunto" name="asunto" required aria-required="true">
                  <div class="invalid-feedback">Ingresá el asunto.</div>
                </div>
                <div class="col-12">
                  <label for="mensaje" class="form-label">Mensaje</label>
                  <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required
                            aria-required="true"></textarea>
                  <div class="invalid-feedback">Escribí tu mensaje.</div>
                </div>
              </div>
              <div class="col-12 mt-4 d-grid d-sm-flex gap-3">
                <button class="btn btn-turquesa font-bankgothic" type="submit">
                  <i class="bi bi-send me-1"></i> Enviar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card bg-azul text-light border-light h-100">
          <div class="card-body">
            <h3 class="fs-3 font-bankgothic fw-bold mb-3">Datos de la empresa</h3>
            <ul class="list-unstyled mb-0">
              <li><i class="bi bi-geo-alt me-2 text-turquesa"></i> Calle 55 Nro 681 Dpto 13D, La Plata</li>
              <li><i class="bi bi-telephone me-2 text-turquesa"></i> +54 221 200-3474</li>
              <li><i class="bi bi-envelope me-2 text-turquesa"></i> contacto@lilitech.shop</li>
              <li><i class="bi bi-clock me-2 text-turquesa"></i> Lunes a Viernes de 9 a 18 hs</li>
            </ul>
            <div class="mt-3">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d204.4695510856931!2d-57.94820616201116!3d-34.91867364365206!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a2e700223eb265%3A0xe762fdb65ce3bcdc!2sMigas%20Argentinas!5e0!3m2!1ses!2sar!4v1757091381018!5m2!1ses!2sar"
                allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
