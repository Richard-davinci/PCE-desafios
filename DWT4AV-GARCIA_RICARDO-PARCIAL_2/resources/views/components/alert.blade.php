@props([
  'type' => 'success',
  'message' => null,
  'errors' => [],
  'small' => false,
])

@php
    $colors = [
      'success' => 'bg-turquesa text-dark',
      'danger'  => 'bg-danger text-light',
      'warning' => 'bg-warning text-dark',
      'info'    => 'bg-azul text-light',
    ];

    $icons = [
    'success' => 'fa-circle-check',
    'danger'  => 'fa-triangle-exclamation',
    'warning' => 'fa-circle-exclamation',
    'info'    => 'fa-circle-info',
  ];


    $colorClass = $colors[$type] ?? 'bg-azul text-light';
    $icon = $icons[$type] ?? 'fa-info-circle';
@endphp

@if($message || (is_array($errors) && count($errors)))
    <div
            class="{{ $small ? 'mt-2 px-2 py-1 small rounded' : 'alert alert-dismissible fade show shadow-sm p-3 rounded' }}
           {{ $colorClass }} font-bankgothic d-flex align-items-center gap-2"
            role="alert">

        <i class="fa-solid {{ $icon }}"></i>

        {{-- Mensaje único --}}
        @if($message)
            <span>{{ $message }}</span>
        @endif

        {{-- Lista de errores --}}
        @if(is_array($errors) && count($errors))
            <ul class="mb-0 ps-3">
                @foreach($errors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        @unless($small)
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        @endunless
    </div>
@endif
