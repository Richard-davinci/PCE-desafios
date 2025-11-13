<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
  public function run(): void
  {
    // Trae solo los usuarios con rol "user"
    $users = User::onlyUsers()->get();

    // Trae todos los servicios activos con sus planes
    $services = Service::where('status', 'Activo')
      ->with('plans')
      ->get();

    // Si no hay usuarios o servicios, salimos
    if ($users->isEmpty() || $services->isEmpty()) {
      return;
    }

    foreach ($users as $user) {
      // Asignar 1 o 2 servicios al azar por usuario
      $randomServices = $services->random(min(2, $services->count()));

      foreach ($randomServices as $service) {
        // Seleccionar un plan aleatorio del servicio
        $plan = $service->plans->random();

        // Calcular fechas según tipo
        $start = Carbon::now()->subDays(rand(1, 20));
        $next = match (strtolower($plan->type)) {
          'mensual' => $start->copy()->addMonth(),
          'anual' => $start->copy()->addYear(),
          default => null,
        };

        Subscription::create([
          'user_id' => $user->id,
          'service_id' => $service->id,
          'plan_id' => $plan->id,
          'price' => $plan->price,
          'status' => 'activa',
          'started_at' => $start,
          'next_renewal_at' => $next,
          'canceled_at' => null,
        ]);
      }
    }
  }
}
