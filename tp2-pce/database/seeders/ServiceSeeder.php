<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;


class ServiceSeeder extends Seeder
{
  public function run(): void
  {
    $services = [
      [
        'name' => 'Diseño de Branding',
        'subtitle' => 'Creación de identidad visual profesional',
        'description' => 'Desarrollamos la identidad visual completa de tu marca, desde el logo hasta el manual de marca, garantizando coherencia y presencia profesional.',
        'conditions' => ['Entrega en 7 dias habiles', 'Incluye 2 revisiones', 'Soporte via email'],
        'image' => 'branding-cover.webp',
        'category_id' => 4, // Diseño Gráfico
      ],
      [
        'name' => 'Desarrollo E-Commerce',
        'subtitle' => 'Tienda online lista para vender',
        'description' => 'Creamos tu tienda online con carrito de compras, pasarela de pagos y panel de administración, lista para vender desde el primer día.',
        'conditions' => ['Entrega en 15 días', 'Soporte por 3 meses', 'Hosting gratuito por 1 año'],
        'image' => 'ecommerce-cover.webp',
        'category_id' => 1, // Desarrollo Web
      ],
      [
        'name' => 'Formularios',
        'subtitle' => 'Automatizá tus procesos de contacto',
        'description' => 'Desarrollamos formularios dinámicos conectados a tu base de datos o correo para optimizar la captación de clientes.',
        'conditions' => ['Entrega en 5 dias', 'Hasta 3 campos personalizados', 'Integracion con correo'],
        'image' => 'formulario.webp',
        'category_id' => 1,
      ],
      [
        'name' => 'Servicio de Hosting',
        'subtitle' => 'Hosting veloz y seguro',
        'description' => 'Alojá tu sitio web con tecnología de punta, certificados SSL y copias de seguridad automáticas.',
        'conditions' => ['Uptime garantizado del 99.9%', 'Soporte 24/7', 'Certificado SSL gratuito'],
        'image' => 'hosting.webp',
        'category_id' => 2, // Infraestructura
      ],
      [
        'name' => 'Sitio Institucional',
        'subtitle' => 'Mostrá tu marca con estilo profesional',
        'description' => 'Creamos sitios institucionales modernos, rápidos y optimizados para mostrar tus servicios y captar clientes.',
        'conditions' => ['Entrega en 10 dias', 'Diseño responsive incluido', 'Optimizacion SEO basica'],
        'image' => 'institucional-cover.webp',
        'category_id' => 1,
      ],
      [
        'name' => 'Mantenimiento Web',
        'subtitle' => 'Nos ocupamos de todo por vos',
        'description' => 'Mantené tu web siempre actualizada y segura con nuestros planes de mantenimiento mensuales y anuales.',
        'conditions' => ['Backups semanales', 'Actualizaciones automáticas', 'Soporte tecnico prioritario'],
        'image' => 'mantenimiento-cover.webp',
        'category_id' => 2,
      ],
      [
        'name' => 'SEO y Posicionamiento',
        'subtitle' => 'Llevá tu marca a lo más alto de Google',
        'description' => 'Optimizamos tu sitio para mejorar su visibilidad en buscadores y atraer más clientes de forma orgánica.',
        'conditions' => ['Informe mensual de resultados', 'Optimizacion de palabras clave', 'Analisis de competencia'],
        'image' => 'seo-cover.webp',
        'category_id' => 5, // Marketing Digital
      ],
    ];

    foreach ($services as $service) {
      $serviceModel = Service::create([
        'name' => $service['name'],
        'subtitle' => $service['subtitle'],
        'description' => $service['description'],
        'conditions' => $service['conditions'], // array directamente
        'image' => $service['image'],
        'category_id' => $service['category_id'],
        'status' => 'Activo',
        'created_at' => now(),
        'updated_at' => now(),
      ]);

    }
  }
}
