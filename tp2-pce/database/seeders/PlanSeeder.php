<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use Carbon\Carbon;

class PlanSeeder extends Seeder
{
  public function run(): void
  {
    $services = Service::all();

    foreach ($services as $service) {
      // --- PLANES MENSUALES ---
      $service->plans()->createMany([
        [
          'name' => 'Básico',
          'price' => rand(9990, 49990),
          'type' => 'mensual',
          'features' => [
            'Soporte estándar',
            'Actualizaciones básicas',
            'Acceso limitado a herramientas'
          ],
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'name' => 'Pro',
          'price' => rand(59990, 99990),
          'type' => 'mensual',
          'features' => [
            'Soporte prioritario',
            'Actualizaciones automáticas',
            'Integraciones premium'
          ],
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'name' => 'Empresarial',
          'price' => rand(119990, 199990),
          'type' => 'mensual',
          'features' => [
            'Soporte 24/7',
            'Escalabilidad avanzada',
            'Gestor de cuenta dedicado'
          ],
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
      ]);

      // --- PLANES ANUALES ---
      $service->plans()->createMany([
        [
          'name' => 'Básico',
          'price' => rand(99990, 199990),
          'type' => 'anual',
          'features' => [
            'Soporte estándar anual',
            'Actualizaciones incluidas',
            'Descuento por pago anual'
          ],
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'name' => 'Pro',
          'price' => rand(199990, 299990),
          'type' => 'anual',
          'features' => [
            'Soporte premium anual',
            'Backups automáticos',
            'Herramientas avanzadas'
          ],
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
        [
          'name' => 'Empresarial',
          'price' => rand(299990, 499990),
          'type' => 'anual',
          'features' => [
            'Soporte 24/7 dedicado',
            'Implementaciones personalizadas',
            'Asesor técnico asignado'
          ],
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ],
      ]);
    }
  }
}
