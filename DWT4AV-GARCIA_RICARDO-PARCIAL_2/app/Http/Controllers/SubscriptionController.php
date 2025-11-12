<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Service;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
  public function preview(Request $request)
  {
    $request->validate([
      'service' => ['required', 'integer', 'exists:services,id'],
      'plan' => ['required', 'integer', 'exists:plans,id'],
    ]);

    $service = Service::where('status', 'Activo')->findOrFail($request->integer('service'));
    $plan = Plan::where('service_id', $service->id)->findOrFail($request->integer('plan'));

    // Guardamos un snapshot mínimo en sesión para la pantalla de "gracias"
    session()->put('checkout.preview', [
      'service_id' => $service->id,
      'service_name' => $service->name,
      'plan_id' => $plan->id,
      'plan_name' => $plan->name,
      'plan_type' => $plan->type,
      'price' => $plan->price,
    ]);

    // Renderiza tu vista de pre-visualización
    return view('checkout.preview', compact('service', 'plan'));
  }

  /**
   * Gracias por suscribirte.
   * Lee el snapshot de sesión y muestra datos; si no hay snapshot, muestra genérico.
   */
  public function thanks(Request $request)
  {
    $subId = session()->pull('checkout.last_subscription_id');
    $service = null; $plan = null;

    if ($subId) {
      $sub = Subscription::with(['service','plan'])->find($subId);
      if ($sub) {
        $service = $sub->service;
        $plan    = $sub->plan;
      }
    } else {
      // Fallback: si no viene de confirm(), no rompas la vista
      $sub = null;
    }

    return view('checkout.thanks', compact('service','plan','sub'));
  }


  /**
   * Mis suscripciones (usuario logueado).
   */
  public function userIndex(Request $request)
  {
    $userId = Auth::id();

    $subscriptions = Subscription::with(['service', 'plan'])
      ->forUser($userId)
      ->orderBy('created_at', 'desc')
      ->paginate(12)
      ->withQueryString();

    return view('user.subscriptions', compact('subscriptions'));
  }

  /**
   * Suscripciones de un usuario (vista admin).
   */
  public function adminUserSubscriptions(User $user)
  {
    $subscriptions = Subscription::with(['service', 'plan'])
      ->forUser($user->id)
      ->orderBy('created_at', 'desc')
      ->paginate(12)
      ->withQueryString();

    return view('admin.users.subscriptions', compact('user', 'subscriptions'));
  }

  public function confirm(\Illuminate\Http\Request $request)
  {
    $userId = \Auth::id();

    // 1) Tomamos snapshot de la pre-vista (lo guardaste en preview())
    $snap = session('checkout.preview');

    // 2) Aceptamos también IDs del form por si querés doble verificación
    $serviceId = $request->integer('service_id') ?: ($snap['service_id'] ?? null);
    $planId = $request->integer('plan_id') ?: ($snap['plan_id'] ?? null);

    // Validaciones mínimas
    abort_unless($serviceId && $planId, 422, 'Faltan datos de suscripción.');

    $service = \App\Models\Service::where('status', 'Activo')->findOrFail($serviceId);
    $plan = \App\Models\Plan::where('service_id', $service->id)->findOrFail($planId);

    // 3) Evitar duplicar activa del mismo servicio (opcional pero recomendado)
    $already = \App\Models\Subscription::where([
      'user_id' => $userId,
      'service_id' => $service->id,
      'status' => 'activa',
    ])->first();

    if ($already) {
      // Si ya tiene una activa, podés simplemente redirigir a thanks con esa
      session()->forget('checkout.preview');
      session()->flash('checkout.last_subscription_id', $already->id);
      return redirect()->route('checkout.thanks');
    }

    // 4) Fechas básicas según tipo de plan (MVP)
    $now = now();
    $next = null;
    switch (strtolower($plan->type)) {
      case 'mensual':
        $next = $now->copy()->addMonth();
        break;
      case 'anual':
      case 'anual ':
        $next = $now->copy()->addYear();
        break;
      default: // 'único' u otros
        $next = null;
        break;
    }

    // Precio mostrado (si lo guardaste en snapshot), fallback al del plan
    $price = $snap['price'] ?? $plan->price;

    // 5) Crear la suscripción enlazada al usuario
    $subscription = \App\Models\Subscription::create([
      'user_id' => $userId,
      'service_id' => $service->id,
      'plan_id' => $plan->id,
      'price' => $price,
      'status' => 'activa',
      'started_at' => $now,
      'next_renewal_at' => $next,
    ]);

    // 6) Limpiar snapshot y pasar id a "Gracias"
    session()->forget('checkout.preview');
    session()->flash('checkout.last_subscription_id', $subscription->id);

    return redirect()->route('checkout.thanks');
  }

}
