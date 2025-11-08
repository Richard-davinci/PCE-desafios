<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{

  public function run(): void
  {
    // 3 usuarios administradores
    User::create([
      'name' => 'Ricardo Garcia',
      'email' => 'ricardogarci4@gmail.com',
      'password' => Hash::make('user'),
      'role' => 'user',
      'city' => 'Córdoba',
      'phone' => '3511111111',
      'profile_photo' => 'img/ricardo.webp',
    ]);

    User::create([
      'name' => 'Bruno Pérez',
      'email' => 'admin@gmail.com',
      'password' => Hash::make('admin'),
      'role' => 'admin',
      'city' => 'Rosario',
      'phone' => '3412222222',
      'profile_photo' => 'img/ricardo.webp',
    ]);

    User::create([
      'name' => 'Carlos Navarro',
      'email' => 'admin2@gmail.com',
      'password' => Hash::make('admin'),
      'role' => 'admin',
      'city' => 'Buenos Aires',
      'phone' => '1133333333',
      'profile_photo' => 'img/ricardo.webp',
    ]);

    // 5 usuarios normales
    User::create([
      'name' => 'Juan Pérez',
      'email' => 'juan@gmail.com',
      'password' => Hash::make('user'),
      'role' => 'user',
      'city' => 'Mendoza',
      'phone' => '2614444444',
      'profile_photo' => 'img/ricardo.webp',
    ]);

    User::create([
      'name' => 'Laura Gómez',
      'email' => 'laura@gmail.com',
      'password' => Hash::make('user'),
      'role' => 'user',
      'city' => 'La Plata',
      'phone' => '2215555555',
      'profile_photo' => 'img/ricardo.webp',
    ]);

    User::create([
      'name' => 'Marcos Díaz',
      'email' => 'marcos@gmail.com',
      'password' => Hash::make('user'),
      'role' => 'user',
      'city' => 'Salta',
      'phone' => '3876666666',
      'profile_photo' => 'img/ricardo.webp',
    ]);

    User::create([
      'name' => 'Sofía López',
      'email' => 'sofia@gmail.com',
      'password' => Hash::make('user'),
      'role' => 'user',
      'city' => 'San Juan',
      'phone' => '2647777777',
      'profile_photo' => 'img/ricardo.webp',
    ]);

    User::create([
      'name' => 'Pedro Sánchez',
      'email' => 'pedro@gmail.com',
      'password' => Hash::make('admin'),
      'role' => 'admin',
      'city' => 'Santa Fe',
      'phone' => '3428888888',
      'profile_photo' => 'img/ricardo.webp',
    ]);
  }
}
