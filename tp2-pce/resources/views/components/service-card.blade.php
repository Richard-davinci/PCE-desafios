@props(['image', 'alt', 'title', 'description', 'price', 'link'])
<div class="col-md-6 col-lg-4">
  <a href="{{ $link }}" class="text-decoration-none card-link-stretch">
    <article class="card bg-azul text-light border-light shadow-sm service-card h-100 transition-move">
      <img src="{{ $image }}"
           class="card-img-top" alt="{{ $alt }}"
           loading="lazy" decoding="async">
      <div class="card-body">
        <h3 class="font-bankgothic fs-5 text-turquesa">{{ $title }}</h3>
        <p class="text-blanco fs-6">{{ $description }}</p>
        <p class="mb-0 text-blanco fs-6">
          <i class="bi bi-cash-coin me-1 text-turquesa"></i>
          Desde <strong>{{ $price }}</strong>
        </p>
      </div>
    </article>
  </a>
</div>
