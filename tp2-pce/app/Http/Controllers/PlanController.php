<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
  /**
   * Mostrar formulario para gestionar TODOS los planes de un servicio.
   * - Si hay plan único → arranca en modo único
   * - Si hay planes mensuales → arranca en modo mensual
   * - Si no hay nada → por defecto modo único
   */
  public function edit(Service $service)
  {
    $service->load('plans');

    $byType = $service->plans->groupBy('type');
    // Plan único
    $unique = optional($byType->get('único'))->first();
    // Planes mensuales por nombre
    $mensuales = $byType->get('mensual', collect())->keyBy('name');

    $pBasico = $mensuales->get('Básico');
    $pPro = $mensuales->get('Pro');
    $pEmpresarial = $mensuales->get('Empresarial');

    // Deetermino modo inicial
    $mode = $unique
      ? 'unico'
      : ($mensuales->isNotEmpty() ? 'mensual' : 'unico');

    return view('admin.plans.edit', compact(
      'service',
      'unique',
      'pBasico',
      'pPro',
      'pEmpresarial',
      'mode'
    ));
  }

  /**
   * Guardar TODOS los planes de un servicio en una sola acción
   *
   * Reglas:
   * - mode = unico:
   *    - borra todos los planes anteriores
   *    - crea SOLO un plan tipo 'único'
   * - mode = mensual:
   *    - borra todos los planes anteriores
   *    - crea 3 planes mensuales: Básico, Pro, Empresarial
   */
  public function update(Request $request, Service $service)
  {
    $mode = $request->input('mode', 'unico');

    // Validación según modo
    $rules = [
      'mode' => 'required|in:unico,mensual',
    ];

    if ($mode === 'unico') {
      $rules['plans.unico.price'] = 'required|numeric|min:0';
      $rules['plans.unico.features'] = 'nullable|string';
    } else { // mensual
      $rules['plans.basico.price'] = 'nullable|numeric|min:0';
      $rules['plans.basico.features'] = 'nullable|string';
      $rules['plans.basico.discount'] = 'nullable|numeric|min:0|max:100';

      $rules['plans.pro.price'] = 'nullable|numeric|min:0';
      $rules['plans.pro.features'] = 'nullable|string';
      $rules['plans.pro.discount'] = 'nullable|numeric|min:0|max:100';

      $rules['plans.empresarial.price'] = 'nullable|numeric|min:0';
      $rules['plans.empresarial.features'] = 'nullable|string';
      $rules['plans.empresarial.discount'] = 'nullable|numeric|min:0|max:100';
    }

    $data = $request->validate($rules);

    DB::transaction(function () use ($service, $mode, $data) {

      // Siempre limpio los planes actuales
      $service->plans()->delete();

      //MODO ÚNICO
      if ($mode === 'unico') {
        $p = $data['plans']['unico'] ?? null;

        if ($p && $p['price'] !== null && $p['price'] !== '') {
          $service->plans()->create([
            'name' => 'Único',
            'type' => 'único',
            'price' => $p['price'],
            'features' => $this->parseFeatures($p['features'] ?? ''),
          ]);
        }
      }

      //MODO MENSUAL crea mensual + anual  prara cada plan con precio
      if ($mode === 'mensual') {
        $tiers = [
          'basico' => 'Básico',
          'pro' => 'Pro',
          'empresarial' => 'Empresarial',
        ];

        foreach ($tiers as $key => $name) {
          $row = $data['plans'][$key] ?? null;

          if (!$row || $row['price'] === null || $row['price'] === '') {
            continue;
          }

          $price = (float)$row['price'];// precio mensual
          $discount = isset($row['discount']) && $row['discount'] !== ''
            ? (float)$row['discount']
            : 0.0;

          $features = $this->parseFeatures($row['features'] ?? '');

          // Plan mensual
          $service->plans()->create([
            'name' => $name,
            'type' => 'mensual',
            'price' => $price,
            'discount' => $discount > 0 ? $discount : null,
            'features' => $features,
          ]);

          // Plan anual
          $annualPrice = $price * 12;
          if ($discount > 0) {
            $annualPrice = $annualPrice * (1 - ($discount / 100));
          }

          $service->plans()->create([
            'name' => $name,
            'type' => 'anual',
            'price' => round($annualPrice, 2),
            'discount' => $discount > 0 ? $discount : null,
            'features' => $features,
          ]);
        }
      }
    });

    return redirect()
      ->route('admin.services.index')
      ->with('success', 'Planes actualizados correctamente.');
  }


  /**
   * Convierte "Hosting, Dominio, SSL" en ['Hosting','Dominio','SSL']
   * para guardar en columna JSON (features).
   */
  private function parseFeatures(?string $features): array
  {
    if (!$features) {
      return [];
    }

    return collect(explode(',', $features))
      ->map(fn($f) => trim($f))
      ->filter()
      ->values()
      ->toArray();
  }
}
