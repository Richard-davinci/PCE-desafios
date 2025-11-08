@props(['image', 'alt', 'title', 'description', 'link'])
<div class="col-md-6 col-lg-4">
  <a href="{{ $link }}" class="text-decoration-none card-link-stretch">
    <article class="card bg-azul text-light border-light shadow-sm service-card h-100 transition-move">
      <img src="{{ $image }}"
           class="card-img-top" alt="{{ $alt }}"
           loading="lazy" decoding="async">
      <div class="card-body">
        <h3 class="font-bankgothic fs-5 text-turquesa">{{ $title }}</h3>
        <p class="text-blanco fs-6">{{ $description }}</p>
      </div>
    </article>
  </a>
</div>
