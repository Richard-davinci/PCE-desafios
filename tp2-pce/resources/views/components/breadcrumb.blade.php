@props([
  // Estructura: [['label' => 'Home', 'route' => 'pages.home'], ['label' => 'Servicios', 'route' => 'admin.services.index'], ['label' => 'Crear']]
  'items' => [],

  // Separador visual (opcional): '›', '/', '»', etc. Si no usás, queda el default de Bootstrap.
  'separator' => null,

  // Clases extra para wrapper (por si querés variantes de color/fondo)
  'class' => '',
])

@php
  // Normalizo items: permito string simple, o array con label/route/url
  $normalized = collect($items)->map(function ($it) {
    if (is_string($it)) return ['label' => $it, 'route' => null, 'url' => null];
    return [
      'label' => $it['label'] ?? '',
      'route' => $it['route'] ?? null,
      'url'   => $it['url']   ?? null,
    ];
  })->values();

  $lastIndex = $normalized->count() - 1;
@endphp

<nav aria-label="breadcrumb" class="{{ $class }}">
  <ol class="breadcrumb mb-0 font-bankgothic small align-items-center">
    @foreach ($normalized as $i => $item)
      @php $isLast = $i === $lastIndex; @endphp

      @if ($isLast)
        {{-- Item activo (no link) --}}
        <li class="breadcrumb-item active" aria-current="page">
          {{ $item['label'] }}
        </li>
      @else
        {{-- Item con link (route > url > texto plano) --}}
        <li class="breadcrumb-item">
          @if ($item['route'])
            <a class="text-azul text-decoration-none font-bold fs-5" href="{{ route($item['route']) }}">
              {{ $item['label'] }}
            </a>
          @elseif ($item['url'])
            <a class="text-azul text-decoration-none font-bold fs-5" href="{{ $item['url'] }}">
              {{ $item['label'] }}
            </a>
          @else
            <span class="text-azul font-bold ">{{ $item['label'] }}</span>
          @endif
        </li>
      @endif

      {{-- Separador custom opcional --}}
      @if(!$isLast && $separator)
        <li class="px-1 text-turquesa fs-4 fw-bold"> {{ $separator }} </li>
      @endif
    @endforeach
  </ol>
</nav>
