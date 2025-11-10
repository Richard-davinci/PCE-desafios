<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
  public function run(): void
  {
    DB::table('categories')->insert([
      ['name' => 'Desarrollo Web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),],
      ['name' => 'Infraestructura', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),],
      ['name' => 'Soporte Técnico', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),],
      ['name' => 'Diseño Gráfico', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),],
      ['name' => 'Marketing Digital', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),],
      ['name' => 'Landing Pages & WordPress', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),],
      ['name' => 'Sitios Web Institucionales', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),],
      ['name' => 'Tiendas Online', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),],
      ['name' => 'Mantenimiento Web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),],
      ['name' => 'Diseño & Branding', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),],
      ['name' => 'Seguridad & Backups', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),],
    ]);
  }
}
