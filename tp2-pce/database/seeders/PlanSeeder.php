<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class PlanSeeder extends Seeder
{
  public function run(): void
  {
    // === ELEGÍ ACÁ TUS DOS SERVICIOS "Único" ===
    $uniqueServices = [
      'Sitio Institucional',
      'Diseño de Branding',
    ];

    // Precios base para los tiers mensuales
    $monthlyPrices = [
      'Básico'      => 19990,
      'Pro'         => 29990,
      'Empresarial' => 49990,
    ];

    // Descuentos anuales por tier
    $annualDiscounts = [
      'Básico'      => 0,
      'Pro'         => 10,
      'Empresarial' => 15,
    ];

    // Features base y extras
    $baseFeatures = ['Hosting', 'SSL', 'Panel admin'];
    $proExtras    = ['Soporte prioritario', 'Backups automáticos'];
    $empExtras    = ['Gestor dedicado', 'SLA 24/7'];

    // Config del plan único
    $uniqueName     = 'Empresarial'; // si querés usar otro (Básico/Pro), cambiá acá
    $uniquePrice    = 249990;
    $uniqueFeatures = ['Entrega llave en mano', '1 ronda de ajustes', 'Optimización básica'];

    foreach (Service::all() as $service) {
      if (in_array($service->name, $uniqueServices, true)) {
        // --- Caso ÚNICO ---
        // Limpieza: borro mensual/anual previos si existieran
        $service->plans()->whereIn('type', ['mensual', 'anual'])->delete();

        // Creo/actualizo Único
        $service->plans()->updateOrCreate(
          ['name' => $uniqueName, 'type' => 'único'],
          ['price' => $uniquePrice, 'features' => $uniqueFeatures]
        );
      } else {
        // --- Caso MENSUAL + ANUAL ---
        // Limpieza: borro único si existiera
        $service->plans()->where('type', 'único')->delete();

        // Tiers y features compuestos
        $tiers = [
          'Básico'      => $baseFeatures,
          'Pro'         => array_values(array_unique(array_merge($baseFeatures, $proExtras))),
          'Empresarial' => array_values(array_unique(array_merge($baseFeatures, $proExtras, $empExtras))),
        ];

        foreach ($tiers as $name => $features) {
          // Mensual
          $service->plans()->updateOrCreate(
            ['name' => $name, 'type' => 'mensual'],
            ['price' => $monthlyPrices[$name], 'features' => $features]
          );

          // Anual (derivado del mensual con descuento)
          $annualBase  = $monthlyPrices[$name] * 12;
          $annualFinal = (int) round($annualBase * (1 - $annualDiscounts[$name] / 100));

          $service->plans()->updateOrCreate(
            ['name' => $name, 'type' => 'anual'],
            ['price' => $annualFinal, 'features' => $features]
          );
        }
      }
    }
  }
}
