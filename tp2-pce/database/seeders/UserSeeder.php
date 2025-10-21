<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // ✅ 3 usuarios administradores
    User::create([
      'name' => 'Ricardo Garcia',
      'email' => 'admin1@example.com',
      'password' => Hash::make('admin'),
      'role' => 'admin',
    ]);

    User::create([
      'name' => 'Bruno Pérez',
      'email' => 'admin2@example.com',
      'password' => Hash::make('admin'),
      'role' => 'admin',
    ]);

    User::create([
      'name' => 'Carlos Navarro',
      'email' => 'admin3@example.com',
      'password' => Hash::make('admin'),
      'role' => 'admin',
    ]);

    // ✅ 5 usuarios normales
    User::create([
      'name' => 'Juan Pérez',
      'email' => 'juan@example.com',
      'password' => Hash::make('user'),
      'role' => 'user',
    ]);

    User::create([
      'name' => 'Laura Gómez',
      'email' => 'laura@example.com',
      'password' => Hash::make('user'),
      'role' => 'user',
    ]);

    User::create([
      'name' => 'Marcos Díaz',
      'email' => 'marcos@example.com',
      'password' => Hash::make('user'),
      'role' => 'user',
    ]);

    User::create([
      'name' => 'Sofía López',
      'email' => 'sofia@example.com',
      'password' => Hash::make('user'),
      'role' => 'user',
    ]);

    User::create([
      'name' => 'Pedro Sánchez',
      'email' => 'pedro@example.com',
      'password' => Hash::make('user'),
      'role' => 'user',
    ]);
  }
}
