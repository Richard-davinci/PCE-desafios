<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleAuth
{
  public function handle($request, Closure $next)
  {
    if (!Auth::user()->hasRole('admin')) {
      return redirect()->route('unauthorized');
    }

    return $next($request);
  }

}
