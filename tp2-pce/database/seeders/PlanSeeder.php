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
          'price' => 19990,
          'features' => [
            'Dominio incluido',
            'SSL',
            'Soporte estándar',
          ],
        ]);

        continue;
      }

      // 🔹 Resto: PLANES MENSUALES + ANUALES
      $tiers = [
        'Básico' => [
          'price'    => 19990,
          'discount' => 10,
          'features' => [
            'Hosting 5GB',
            '1 dominio',
            'SSL incluido',
          ],
        ],
        'Pro' => [
          'price'    => 29990,
          'discount' => 15,
          'features' => [
            'Hosting 15GB',
            '2 dominios',
            'SSL + backups automáticos',
            'Soporte prioritario',
          ],
        ],
        'Empresarial' => [
          'price'    => 49990,
          'discount' => 20,
          'features' => [
            'Hosting ilimitado',
            'Dominios ilimitados',
            'Backups diarios',
            'Soporte 24/7',
            'Panel avanzado de estadísticas',
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

        // Plan anual (auto con descuento)
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
