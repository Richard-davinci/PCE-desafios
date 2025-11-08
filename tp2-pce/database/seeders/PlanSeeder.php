<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class PlanSeeder extends Seeder
{
  public function run(): void
  {
    $services = Service::all();

    foreach ($services as $index => $service) {

      // 🔹 Primeros 3 servicios: PLAN ÚNICO
      if ($index < 3) {
        $service->plans()->create([
          'name' => 'Único',
          'type' => 'único',
          'price' => match ($index) {
            0 => 120, // landing simple
            1 => 200, // web profesional
            2 => 350, // ecommerce básico
            default => 150,
          },
          'features' => [
            'Dominio incluido por 1 año',
            'SSL y hosting básico',
            'Diseño responsive',
            'Soporte técnico estándar',
          ],
        ]);

        continue;
      }

      // Resto: PLANES MENSUALES + ANUALES
      $tiers = [
        'Básico' => [
          'price'    => 25,
          'discount' => 10,
          'features' => [
            'Hosting 2GB',
            '1 dominio incluido',
            'SSL gratuito',
            '1 actualización mensual',
          ],
        ],
        'Pro' => [
          'price'    => 45,
          'discount' => 15,
          'features' => [
            'Hosting 5GB',
            '2 dominios incluidos',
            'Backups automáticos',
            'Soporte prioritario',
          ],
        ],
        'Empresarial' => [
          'price'    => 70,
          'discount' => 20,
          'features' => [
            'Hosting ilimitado',
            'Dominios ilimitados',
            'Reportes mensuales',
            'Gestor dedicado y soporte 24/7',
          ],
        ],
      ];

      foreach ($tiers as $name => $data) {
        $monthly   = $data['price'];
        $discount  = $data['discount'];
        $features  = $data['features'];

        // Plan mensual
        $service->plans()->create([
          'name'     => $name,
          'type'     => 'mensual',
          'price'    => $monthly,
          'discount' => $discount,
          'features' => $features,
        ]);

        // Plan anual
        $annualBase  = $monthly * 12;
        $annualFinal = round($annualBase * (1 - $discount / 100), 2);

        $service->plans()->create([
          'name'     => $name,
          'type'     => 'anual',
          'price'    => $annualFinal,
          'discount' => $discount,
          'features' => $features,
        ]);
      }
    }
  }
}
