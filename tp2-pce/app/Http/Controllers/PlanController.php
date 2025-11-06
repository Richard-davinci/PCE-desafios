<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
  /**
   * Crea planes para un servicio desde el modal.
   * - Único: crea 1 plan (name=Empresarial, type=único)
   * - Mensual: crea 3 planes (Básico, Pro, Empresarial) con type=mensual
   */
  public function store(Request $request, Service $service)
  {
    $data = $this->validatePayload($request);

    // Modo enviado por los radios del modal: 'unico' | 'mensual'
    $mode = $request->string('mode')->toString();

    DB::transaction(function () use ($service, $mode, $data) {
      if ($mode === 'unico') {
        // Si voy a dejar Único, elimino Mensual/Anual previos (regla de negocio)
        $service->plans()->whereIn('type', ['mensual', 'anual'])->delete();

        // ÚNICO: solo index 0
        $p = $data['plans'][0];
        $service->plans()->updateOrCreate(
          ['name' => 'Empresarial', 'type' => 'único'], // nombre fijo para enum
          [
            'price' => (int)$p['price'],
            'features' => $this->toFeaturesArray($p['features'] ?? ''),
          ]
        );

      } elseif ($mode === 'mensual') {
        // Si voy a dejar Mensual, elimino Único previo (regla de negocio)
        $service->plans()->where('type', 'único')->delete();

        // MENSUAL: índices 0=Básico, 1=Pro, 2=Empresarial (como en el modal)
        foreach ($data['plans'] as $p) {
          // normalizo nombre (si viniera “Profesional”, lo mapeo a “Pro”)
          $name = $p['name'] === 'Profesional' ? 'Pro' : $p['name'];

          $service->plans()->updateOrCreate(
            ['name' => $name, 'type' => 'mensual'],
            [
              'price' => (int)$p['price'],
              'features' => $this->toFeaturesArray($p['features'] ?? ''),
            ]
          );
        }

        // NOTA: el ANUAL lo derivamos más adelante (mensual * 12 con descuento) o vía seeder.
      }
    });

    return redirect()
      ->route('admin.services.index')
      ->with('success', 'Planes guardados correctamente.');
  }


  /** EDIT:
   *  Carga los planes del servicio para prellenar el modal o una vista standalone.
   *  Si usás el modal en el index, NO es obligatorio este método (pero lo dejo por si lo querés).
   */
  public function edit(Service $service)
  {
    $service->load('plans'); // mensual/anual/único
    return view('admin.plans.edit', compact('service')); // tu vista puede incluir el mismo modal
  }

  /** UPDATE:
   *  Actualiza planes del servicio según el modo:
   *  - 'unico': borra mensuales/anuales y deja ÚNICO (1 registro).
   *  - 'mensual': borra ÚNICO y deja 3 mensuales (Básico, Pro, Empresarial).
   */
  public function update(Request $request, Service $service)
  {
    $data = $this->validatePayload($request);
    $mode = $request->string('mode')->toString(); // 'unico' | 'mensual'

    DB::transaction(function () use ($service, $mode, $data) {
      if ($mode === 'unico') {
        // Limpieza y actualización ÚNICO
        $service->plans()->whereIn('type', ['mensual', 'anual'])->delete();

        $p = $data['plans'][0];
        $service->plans()->updateOrCreate(
          ['name' => 'Empresarial', 'type' => 'único'],
          ['price' => (int)$p['price'], 'features' => $this->toFeaturesArray($p['features'] ?? '')]
        );
      } else {
        // Limpieza y actualización MENSUAL (3 planes)
        $service->plans()->where('type', 'único')->delete();

        foreach ($data['plans'] as $p) {
          $name = $p['name'] === 'Profesional' ? 'Pro' : $p['name'];

          $service->plans()->updateOrCreate(
            ['name' => $name, 'type' => 'mensual'],
            [
              'price' => (int)$p['price'],
              'features' => $this->toFeaturesArray($p['features'] ?? ''),
            ]
          );
        }
        // Si más adelante querés derivar anual acá, lo agregamos.
      }
    });

    return back()->with('success', 'Planes actualizados correctamente.');
  }

  /* ============ helpers compartidos con store() ============ */

  private function validatePayload(Request $request): array
  {
    return $request->validate([
      'mode' => 'required|in:unico,mensual',
      'plans' => 'required|array|min:1',
      'plans.*.name' => 'required|string|in:Básico,Pro,Empresarial,Profesional',
      'plans.*.price' => 'required|numeric|min:0',
      'plans.*.type' => 'required|string|in:único,mensual',
      'plans.*.features' => 'nullable|string',
    ]);
  }


  private function toFeaturesArray(string $csv): array
  {
    $parts = array_map('trim', explode(',', $csv));
    return array_values(array_filter($parts, fn($v) => $v !== ''));
  }
}
