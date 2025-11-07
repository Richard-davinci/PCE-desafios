<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class PlanSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Recorremos todos los servicios existentes
    $services = Service::all();

    foreach ($services as $index => $service) {

      // 🔹 Para los primeros 2 servicios → plan ÚNICO
      if ($index < 2) {
        $service->plans()->create([
          'name' => 'Único',
          'type' => 'único',
          'price' => fake()->numberBetween(100, 500),
          'features' => [
            'Dominio incluido',
            'Soporte técnico básico',
            'Entrega en 5 días hábiles',
          ],
        ]);
      }

      // 🔹 Para los demás → 3 planes MENSUALES + 3 ANUALES
      else {
        // Precios base
        $prices = [
          'Básico' => 150,
          'Pro' => 250,
          'Empresarial' => 400,
        ];

        foreach ($prices as $name => $price) {
          // MENSUAL
          $service->plans()->create([
            'name' => $name,
            'type' => 'mensual',
            'price' => $price,
            'features' => match ($name) {
              'Básico' => [
                'Hosting 5GB',
                '1 dominio',
                'Certificado SSL',
              ],
              'Pro' => [
                'Hosting 15GB',
                '2 dominios',
                'SSL y Backups automáticos',
                'Soporte prioritario',
              ],
              'Empresarial' => [
                'Hosting ilimitado',
                'Dominios ilimitados',
                'Backups diarios',
                'Soporte 24/7',
                'Panel de estadísticas avanzado',
              ],
            },
          ]);

          // ANUAL (precio mensual * 12 con 10-20% descuento)
          $discount = fake()->numberBetween(10, 20);
          $service->plans()->create([
            'name' => $name,
            'type' => 'anual',
            'price' => round($price * 12 * (1 - $discount / 100), 2),
            'discount' => $discount,
            'features' => match ($name) {
              'Básico' => [
                'Hosting 5GB',
                '1 dominio',
                'Certificado SSL',
                'Descuento anual del ' . $discount . '%',
              ],
              'Pro' => [
                'Hosting 15GB',
                '2 dominios',
                'SSL y Backups automáticos',
                'Soporte prioritario',
                'Descuento anual del ' . $discount . '%',
              ],
              'Empresarial' => [
                'Hosting ilimitado',
                'Dominios ilimitados',
                'Backups diarios',
                'Soporte 24/7',
                'Panel de estadísticas avanzado',
                'Descuento anual del ' . $discount . '%',
              ],
            },
          ]);
        }
      }
    }
  }
}
