<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Service;
use App\Models\Subscription;
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

    return view('checkout.preview', compact('service', 'plan'));
  }

  /**
   * Gracias por suscribirte.
   * Lee el snapshot de sesión y muestra datos; si no hay snapshot, muestra genérico.
   */
  public function thanks(Request $request)
  {
    $sub = null;
    $service = null;
    $plan = null;

    if ($request->user()?->subscriptions()->exists()) {
      $sub = $request->user()->subscriptions()
        ->with(['service', 'plan'])
        ->latest()
        ->first();

      if ($sub) {
        $service = $sub->service;
        $plan = $sub->plan;
      }
    }

    return view('checkout.thanks', compact('service', 'plan', 'sub'));
  }


  /**
   * Mis suscripciones (usuario logueado).
   */
  public function userIndex(Request $request)
  {
    $userId = Auth::id();

    $subscriptions = Subscription::with(['service', 'plan'])
      ->orderBy('created_at', 'desc')
      ->paginate(12)
      ->withQueryString();

    return view('user.subscriptions', compact('subscriptions'));
  }


  public function confirm(Request $request)
  {
    $userId = \Auth::id();

    $serviceId = $request->input('service_id');
    $planId = $request->input('plan_id');

    $service = Service::where('status', 'Activo')->findOrFail($serviceId);
    $plan = Plan::where('service_id', $service->id)->findOrFail($planId);

    // Evitar duplicar del mismo servicio
    $already = Subscription::where([
      'user_id' => $userId,
      'service_id' => $service->id,
      'status' => 'activa',
    ])->first();

    if ($already) {
      return view('errors.already', [
        'message' => 'Ya tienes una suscripción activa para este servicio.',
        'subscription' => $already,
      ]);
    }

    // Fechas básicas
    $now = now();
    switch (strtolower($plan->type)) {
      case 'mensual':
        $next = $now->copy()->addMonth();
        break;
      case 'anual':
      case 'anual ':
        $next = $now->copy()->addYear();
        break;
      default: // 'único'
        $next = null;
        break;
    }

    $subscription = Subscription::create([
      'user_id' => $userId,
      'service_id' => $service->id,
      'plan_id' => $plan->id,
      'price' => $plan->price,
      'status' => 'activa',
      'started_at' => $now,
      'next_renewal_at' => $next,
    ]);

    session()->flash('checkout.last_subscription_id', $subscription->id);

    return redirect()->route('checkout.thanks');
  }

  public function already(Subscription $subscription)
  {

    return view('errors.already', [
      'subscription' => $subscription,
    ]);

  }
}
