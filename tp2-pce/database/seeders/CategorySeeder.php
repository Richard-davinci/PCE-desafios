<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
  public function run(): void
  {
    DB::table('categories')->insert([
      ['name' => 'Desarrollo Web',    'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
      ['name' => 'Infraestructura',   'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
      ['name' => 'Soporte Técnico',   'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
      ['name' => 'Diseño Gráfico',    'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
      ['name' => 'Marketing Digital', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
    ]);
  }
}
