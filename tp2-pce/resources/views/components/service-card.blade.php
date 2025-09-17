<div class="col-md-6 col-lg-4">
    <article class="card bg-azul text-light border-light shadow-sm service-card">
        <img src="{{ $image }}"
             class="card-img-top" alt="{{ $alt }}"
             loading="lazy" decoding="async">
        <div class="card-body">
            <h3 class="font-bankgothic fs-4">{{ $title }}</h3>
            <p class="text-blanco">{{ $description }}</p>
            <p class="mb-0 text-blanco"><i class="bi bi-cash-coin me-1"></i>Desde <strong>{{ $price }}</strong></p>
            <a class="btn btn-turquesa mt-3" href="{{ $linkId }}">Ver más </a>
        </div>
    </article>
</div>
