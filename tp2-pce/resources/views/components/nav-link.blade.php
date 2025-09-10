<a class="nav-link text-light {{ request()->routeIs($route) ? 'active' : '' }}"
   {!! request()->routeIs($route) ? 'aria-current="page"' : '' !!}
   href="{{ route($route)}}"
>{{$slot}}</a>
