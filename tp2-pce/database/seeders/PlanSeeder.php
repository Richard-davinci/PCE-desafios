<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PlanSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('plans')->insert([
      // Sitio Institucional
      [
        'service_id' => 1,
        'name' => 'Básico',
        'price' => 149990,
        'type' => 'único',
        'features' => json_encode(['Hosting 1 año', '1 dominio .com', 'Hasta 4 secciones']),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'service_id' => 1,
        'name' => 'Pro',
        'price' => 199990,
        'type' => 'único',
        'features' => json_encode(['Hosting 2 años', 'SEO básico', 'Blog integrado']),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],

      // Tienda Online
      [
        'service_id' => 2,
        'name' => 'Shop Básico',
        'price' => 249990,
        'type' => 'único',
        'features' => json_encode(['Hasta 50 productos', 'MercadoPago', 'Panel admin']),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'service_id' => 2,
        'name' => 'Shop Plus',
        'price' => 329990,
        'type' => 'único',
        'features' => json_encode(['Catálogo ilimitado', 'Descuentos y cupones']),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],

      // Hosting
      [
        'service_id' => 3,
        'name' => 'Starter',
        'price' => 14990,
        'type' => 'mensual',
        'features' => json_encode(['1 GB espacio', 'SSL incluido', 'Soporte básico']),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'service_id' => 3,
        'name' => 'Business',
        'price' => 29990,
        'type' => 'mensual',
        'features' => json_encode(['10 GB espacio', 'Soporte 24/7', 'Correo corporativo']),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],

      // Mantenimiento
      [
        'service_id' => 4,
        'name' => 'Mensual',
        'price' => 29990,
        'type' => 'mensual',
        'features' => json_encode(['Backups semanales', 'Actualizaciones menores']),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'service_id' => 4,
        'name' => 'Anual',
        'price' => 299990,
        'type' => 'anual',
        'features' => json_encode(['Monitoreo 24/7', 'Soporte técnico incluido']),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],

      // Branding
      [
        'service_id' => 5,
        'name' => 'Starter',
        'price' => 89990,
        'type' => 'único',
        'features' => json_encode(['Logo + paleta', '3 revisiones']),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'service_id' => 5,
        'name' => 'Full Brand',
        'price' => 149990,
        'type' => 'único',
        'features' => json_encode(['Manual de marca', 'Papelería digital']),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],

      // SEO
      [
        'service_id' => 6,
        'name' => 'Auditoría',
        'price' => 79990,
        'type' => 'único',
        'features' => json_encode(['Reporte técnico', 'Recomendaciones SEO']),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'service_id' => 6,
        'name' => 'SEO Mensual',
        'price' => 99990,
        'type' => 'mensual',
        'features' => json_encode(['Optimización on-page', 'Link building básico']),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
    ]);
  }
}
