<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Service;
use Illuminate\Http\Request;


/** =========================================================
 *          Profe Bruno te dejo los Comentarios
 *          para poder entender este controller xq es muy largo
 * =========================================================

 * Controlador de Planes asociados a un Servicio.
 *
 * Cada servicio puede tener un solo modo activo:
 * - Modo ÚNICO → un solo plan (type = "único").
 * - Modo MENSUAL → tres tiers fijos (Básico, Pro, Empresarial),
 *   cada uno con su versión mensual (editable) y anual (calculada).
 *
 * Reglas:
 * - Al guardar ÚNICO → se eliminan los planes mensuales/anuales.
 * - Al guardar MENSUAL → se elimina el plan único previo.
 * - Los planes ANUALES nunca se editan, se recalculan automáticamente.
 *
 * Helpers:
 * - deletePlans() → elimina planes según tipo o nombre.
 * - createOrUpdatePlan() → crea o actualiza un plan.
 * - saveUniquePlan() / saveMonthlyPlans() → manejan la lógica de guardado.
 * - parseFeatures() / featuresToText() → formatean características.
 */
class PlanController extends Controller
{
  public function create(Service $service)
  {
    $mode = old('mode', 'unico');

    return view('admin.plans.create', [
      'service' => $service,
      'mode' => $mode,
    ]);
  }

  public function store(Request $request, Service $service)
  {
    $validated = $this->validatePlans($request);
    $mode = $request->input('mode', 'unico');

    // false = es para decirle que estoy creando planes
    $this->savePlans($service, $mode, $validated['plans'] ?? [], false);

    return redirect()
      ->route('admin.services.index')
      ->with('success', 'Planes creados correctamente.');
  }

  public function update(Request $request, Service $service)
  {
    $validated = $this->validatePlans($request);
    $mode = $request->input('mode', 'unico');

    // true = es para decirle que estoy editando
    $this->savePlans($service, $mode, $validated['plans'] ?? [], true);

    return redirect()
      ->route('admin.services.index')
      ->with('success', 'Planes actualizados correctamente.');
  }


  public function edit(Service $service)
  {
    $plans = $this->loadPlansForService($service);

    // Combina el servicio + todos los datos de planes en un solo array
    return view('admin.plans.edit', array_merge(
      ['service' => $service], $plans));
  }

  /** =========================================================
   *                     METODOS
   * =========================================================
   */
  /**
   * =========================================================
   *                   VALIDACIÓN
   * =========================================================
   * Valida los datos de planes según el modo seleccionado.
   * Devuelve el array validado.
   */
  private function validatePlans(Request $request): array
  {
    $mode = $request->input('mode', 'unico');//valor del input radio

    $rules = [];//regla para la validation
    $messages = [];//para el mensaje de error

    // =========================================================
    //                  PLANES ÚNICO
    // =========================================================
    if ($mode === 'unico') {
      $rules['plans.unico.price'] = 'required|numeric|min:1';
      $rules['plans.unico.features'] = 'required|string|min:3';

      $messages += [
        'plans.unico.price.required' => 'El precio del plan único es obligatorio.',
        'plans.unico.price.numeric' => 'El precio del plan único debe ser numérico.',
        'plans.unico.price.min' => 'El precio del plan único debe ser mayor o igual a 1.',
        'plans.unico.features.required' => 'Las características del plan único son obligatorias.',
        'plans.unico.features.string' => 'Las características del plan único deben ser texto válido.',
        'plans.unico.features.min' => 'Las características del plan único deben tener al menos 3 caracteres.',
      ];
    }
    // =========================================================
    //                  PLANES MENSUALES
    // =========================================================

    else {
      $tiers = [
        'basico' => 'Básico',
        'pro' => 'Profesional',
        'empresarial' => 'Empresarial',
      ];
      // $tiers = array con los tipos de planes disponibles (Básico, Pro, Empresarial)
      // $key = nombre técnico del plan
      // $label = nombre legible mostrado al usuario

      foreach ($tiers as $key => $label) {
        $rules["plans.$key.price"] = 'nullable|numeric|min:1';
        $rules["plans.$key.features"] = 'required_with:plans.' . $key . '.price|string|min:3';
        $rules["plans.$key.discount"] = 'nullable|numeric|min:0|max:100';

        $messages += [
          "plans.$key.price.numeric" => "El precio mensual del Plan $label debe ser numérico.",
          "plans.$key.price.min" => "El precio mensual del Plan $label debe ser mayor o igual a 1.",
          "plans.$key.features.required_with" => "Debés indicar las características del Plan $label cuando cargás un precio.",
          "plans.$key.features.string" => "Las características del Plan $label deben ser texto válido.",
          "plans.$key.features.min" => "Las características del Plan $label deben tener al menos 3 caracteres.",
          "plans.$key.discount.numeric" => "El descuento del Plan $label debe ser numérico.",
          "plans.$key.discount.min" => "El descuento del Plan $label no puede ser negativo.",
          "plans.$key.discount.max" => "El descuento del Plan $label no puede superar el 100%.",
        ];
      }
    }

    return $request->validate($rules, $messages);
  }


  /**
   * =========================================================
   *                    GUARDAR PLANES
   * =========================================================
   *  Decide qué tipo de guardado ejecutar según el modo.
   */
  private function savePlans(Service $service, string $mode, array $plansData, bool $isUpdate): void
  {
    if ($mode === 'unico') {
      $this->saveUniquePlan($service, $plansData, $isUpdate);
    }

    if ($mode === 'mensual') {
      $this->saveMonthlyPlans($service, $plansData, $isUpdate);
    }
  }

  /**
   *  =========================================================
   *        Crea o actualiza el Plan Único de un servicio.
   *  =========================================================
   *
   * - Si $isUpdate = true:
   *     - Elimina planes mensuales/anuales
   *     - Actualiza el plan único si existe, sino lo crea.
   *
   * - Si $isUpdate = false:
   *     - Crea el plan único desde cero
   */
  private function saveUniquePlan(Service $service, array $plansData, bool $isUpdate): void
  {
    $data = $plansData['unico'];

    $price = (float)($data['price'] ?? 0);

    $features = $this->parseFeatures($data['features'] ?? '');

    // Si estamos editando borramos cualquier plan mensual/anual
    if ($isUpdate) {
      $this->deletePlans($service, ['types' => ['mensual', 'anual'],]);
    }

    $this->createOrUpdatePlan(
      $service,
      'Único',   // name
      'único',   // type
      $price,
      $features,
      null,      // sin descuento por ser unico
      $isUpdate
    );
  }


  /**
   *   =========================================================
   *         Crea o actualiza los planes Mensuales + Anuales.
   *   =========================================================   *
   *
   * - Si $isUpdate = true:
   *     - Borra el plan único
   *     - Actualiza o crea cada tier (mensual + anual).
   *     - Si un tier deja de tener precio => se borran sus registros.????
   *
   * - Si $isUpdate = false:
   *     - Crea desde cero los tiers que tengan precio.
   */
  private function saveMonthlyPlans(Service $service, array $plansData, bool $isUpdate): void
  {
    //tier= categorias
    $tiers = [
      'basico' => 'Básico',
      'pro' => 'Pro',
      'empresarial' => 'Empresarial',
    ];

    // Si es edición y paso a modo Mensual → elimino plan único previo
    if ($isUpdate) {
      $this->deletePlans($service, ['types' => ['único']]);
    }

    foreach ($tiers as $key => $nombre) {

      $data = $plansData[$key];
      $price = (float)($data['price'] ?? 0);
      $discount = $data['discount'] !== null && $data['discount'] !== ''
        ? (float)$data['discount']
        : null;
      $features = $this->parseFeatures($data['features'] ?? '');


      // -------------------------------------------------------
      // Plan mensual (editable)
      // -------------------------------------------------------
      $this->createOrUpdatePlan(
        $service,
        $nombre,
        'mensual',
        $price,
        $features,
        $discount,
        $isUpdate
      );

      // -------------------------------------------------------
      // Plan anual
      // -------------------------------------------------------
      $annualPrice = $price * 12 * (1 - (($discount ?? 0) / 100));

      $this->createOrUpdatePlan(
        $service,
        $nombre,
        'anual',
        $annualPrice,
        $features,
        $discount,
        $isUpdate
      );
    }
  }

  /**
   *   =========================================================
   *         Elimina planes de un servicio según filtros.
   *   =========================================================
   *
   * Filtros soportados
   * - 'types' => ['único', 'mensual', 'anual']  // uno o varios
   * - 'name'  => 'Básico'                       // por nombre de tier
   *
   * Si no se pasa ningún filtro -> borra TODOS los planes del servicio.
   */
  private function deletePlans(Service $service, array $filters = []): void
  {
    $query = Plan::where('service_id', $service->id);

    // Filtrar por tipos (mensual, anual, único)
    if (!empty($filters['types'])) {
      $query->whereIn('type', $filters['types']);
    }

    // Filtrar por nombre de plan/tier (Básico, Pro, etc.)
    if (!empty($filters['name'])) {
      $query->where('name', $filters['name']);
    }

    $query->delete();
  }

  /**
   * =========================================================
   *      Crea o actualiza un plan según si ya existe o no.
   * =========================================================
   *
   * @param Service $service Servicio al que pertenece el plan
   * @param string $name Nombre del plan
   * @param string $type Tipo de plan: único, mensual o anual
   * @param float $price Precio del plan
   * @param array $features Lista de características (array)
   * @param float|null $discount Descuento aplicado (solo anual)
   * @param bool $isUpdate Si true, intenta actualizar en lugar de crear
   */
  private function createOrUpdatePlan(Service $service,
                                      string  $name,
                                      string  $type,
                                      float   $price,
                                      array   $features,
                                      ?float  $discount,
                                      bool    $isUpdate = false): void
  {
    if ($isUpdate) {
      $plan = Plan::where('service_id', $service->id)
        ->where('name', $name)
        ->where('type', $type)
        ->first();

      if ($plan) {
        $plan->update([
          'price' => $price,
          'features' => $features,
          'discount' => $discount,
        ]);
        return;
      }
    }

    Plan::create([
      'service_id' => $service->id,
      'name' => $name,
      'type' => $type,
      'price' => $price,
      'features' => $features,
      'discount' => $discount,
    ]);
  }


  /**
   * =========================================================
   * Carga los planes de un servicio para edición
   * =========================================================
   */
  private function loadPlansForService(Service $service): array
  {
    $plans = Plan::where('service_id', $service->id)->get();


    // Clasificación de planes por tipo
    $unique = $plans->firstWhere('type', 'único');
    $monthly = $plans->where('type', 'mensual')->keyBy('name');

    // Detección del modo actual
    $mode = $monthly->isNotEmpty() ? 'mensual' : 'unico';

    // Retorno formateado
    return [
      'hasPlans' => true,
      'mode' => $mode,

      // Único
      'unique' => $unique,
      'uniqueFeatures' => $this->featuresToText($unique->features ?? null),

      // Tiers (usamos keyBy para evitar repetir búsquedas)
      'precioBasico' => optional($monthly->get('Básico'))->price,
      'descuentoBasico' => optional($monthly->get('Básico'))->discount,
      'featuresBasico' => $this->featuresToText(optional($monthly->get('Básico'))->features ?? null),

      'precioPro' => optional($monthly->get('Pro'))->price,
      'descuentoPro' => optional($monthly->get('Pro'))->discount,
      'featuresPro' => $this->featuresToText(optional($monthly->get('Pro'))->features ?? null),

      'precioEmpresas' => optional($monthly->get('Empresarial'))->price,
      'descuentoEmpresas' => optional($monthly->get('Empresarial'))->discount,
      'featuresEmpresarial' => $this->featuresToText(optional($monthly->get('Empresarial'))->features ?? null),
    ];
  }

  /**
   *=========================================================
   *   Convierte texto de características ("a, b, c")
   *   en array ["a", "b", "c"] para guardar como JSON.
   *=========================================================
   */

  private function parseFeatures(string $features): array
  {
    return collect(explode(',', $features))
      ->map(fn($f) => trim($f))
      ->filter()
      ->values()
      ->toArray();
  }

  /**
   * =========================================================
   *    Convierte un array o JSON de características en texto plano.
   *  ["a","b","c"] → "a, b, c"
   * =========================================================
   */
  private function featuresToText($features): string
  {
    // Si ya es array
    if (is_array($features)) {
      return implode(', ', $features);
    }

    // Si es JSON válido
    $decoded = json_decode($features, true);
    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
      return implode(', ', $decoded);
    }

    //ya es texto plano
    return (string)$features;
  }


}
