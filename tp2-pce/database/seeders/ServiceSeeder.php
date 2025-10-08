<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ServiceSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('services')->insert([
      [
        'category_id' => 1,
        'name' => 'Sitio Institucional',
        'status' => 'Activo',
        'subtitle' => 'Ideal para pymes y profesionales',
        'description' => 'Diseño y desarrollo de un sitio web informativo con secciones básicas: Inicio, Nosotros, Servicios y Contacto.',
        'cover_image' => 'img/servicios/institucional-cover.webp',
        'thumb_image' => 'img/servicios/institucional-cover.webp',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'category_id' => 1,
        'name' => 'Tienda Online',
        'status' => 'Activo',
        'subtitle' => 'Solución completa para vender online',
        'description' => 'Desarrollo de tienda virtual con carrito, pasarela de pagos y gestión de productos.',
        'cover_image' => 'img/servicios/ecommerce-cover.webp',
        'thumb_image' => 'img/servicios/ecommerce-cover.webp',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'category_id' => 2,
        'name' => 'Hosting y Servidores',
        'status' => 'Activo',
        'subtitle' => 'Infraestructura confiable y segura',
        'description' => 'Alojamiento web profesional con mantenimiento, certificados SSL y soporte técnico especializado.',
        'cover_image' => 'img/servicios/hosting.webp',
        'thumb_image' => 'img/servicios/hosting.webp',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'category_id' => 3,
        'name' => 'Mantenimiento Web',
        'status' => 'Activo',
        'subtitle' => 'Actualización y respaldo continuo de tu sitio',
        'description' => 'Planes de mantenimiento mensual que incluyen actualizaciones, backups y soporte técnico.',
        'cover_image' => 'img/servicios/mantenimiento-cover.webp',
        'thumb_image' => 'img/servicios/mantenimiento-cover.webp',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'category_id' => 4,
        'name' => 'Branding y Diseño',
        'status' => 'Activo',
        'subtitle' => 'Construí una identidad visual profesional',
        'description' => 'Diseño de marca completa: logo, paleta de colores, tipografía y manual de estilo.',
        'cover_image' => 'img/servicios/branding-cover.webp',
        'thumb_image' => 'img/servicios/branding-cover.webp',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'category_id' => 5,
        'name' => 'SEO y Posicionamiento',
        'status' => 'Activo',
        'subtitle' => 'Mejorá tu presencia en Google',
        'description' => 'Auditoría técnica, palabras clave y optimización on-page para mejorar tu visibilidad en buscadores.',
        'cover_image' => 'img/servicios/seo-cover.webp',
        'thumb_image' => 'img/servicios/seo-cover.webp',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
    ]);
  }
}
