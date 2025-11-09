<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
  public function run(): void
  {

    $categories = Category::pluck('id', 'name');

    $uniqueServices = [
      [
        'name' => 'Landing Page Profesional',
        'category_id' => $categories['Diseño Web'] ?? 1,
        'subtitle' => 'Sitio web de una sola página con diseño personalizado.',
        'description' => 'Ideal para emprendedores o marcas personales que buscan presencia online rápida y efectiva. Incluye diseño responsive, optimización básica para buscadores (SEO) y dominio por 1 año.',
        'conditions' => 'Entrega en un plazo estimado de 7 días hábiles, Incluye una revisión sin costo.',
        'image' => 'landing.webp',
        'status' => 'Borrador',
      ],
      [
        'name' => 'Sitio Web Corporativo',
        'category_id' => $categories['Diseño Web'] ?? 1,
        'subtitle' => 'Sitio institucional completo con hasta 5 secciones.',
        'description' => 'Pensado para pymes y profesionales que necesitan una web sólida. Incluye diseño adaptable, optimización SEO inicial, integración con redes sociales y formulario de contacto.',
        'conditions' => 'Plazo estimado de 10 a 15 días hábiles, Incluye soporte por 30 días después de la entrega.',
        'image' => 'corporativo.webp',
        'status' => 'Activo',
      ],
      [
        'name' => 'Tienda Online Inicial',
        'category_id' => $categories['E-commerce'] ?? 2,
        'subtitle' => 'E-commerce funcional con hasta 20 productos.',
        'description' => 'Diseñada para pequeños negocios que quieren comenzar a vender online. Incluye carrito, medios de pago integrados, panel de control, y hosting por 1 año.',
        'conditions' => 'Plazo de entrega entre 15 y 20 días hábiles, Incluye soporte básico durante el primer mes.',
        'image' => 'ecommerce.webp',
        'status' => 'Pausado',
      ],
    ];


    $recurringServices = [
      [
        'name' => 'Mantenimiento Web',
        'category_id' => $categories['Mantenimiento'] ?? 3,
        'subtitle' => 'Mantené tu sitio actualizado y seguro.',
        'description' => 'Ideal para webs activas que requieren actualizaciones periódicas. Incluye soporte técnico, optimización de rendimiento, actualizaciones de plugins y seguridad.',
        'conditions' => 'Se factura mensualmente o anualmente, Cancelable en cualquier momento sin penalidad.',
        'image' => 'mantenimiento.webp',
        'status' => 'Activo',
      ],
      [
        'name' => 'Gestión de Hosting y Dominio',
        'category_id' => $categories['Hosting'] ?? 4,
        'subtitle' => 'Servicio integral de alojamiento web y dominios.',
        'description' => 'Nos encargamos de la gestión completa de tu hosting y dominio: configuración, seguridad, copias de seguridad y soporte continuo.',
        'conditions' => 'Incluye monitoreo 24/7, Renovación anual automática con aviso previo de 30 días.',
        'image' => 'hosting.webp',
        'status' => 'Activo',
      ],
      [
        'name' => 'Marketing Digital y SEO',
        'category_id' => $categories['Marketing'] ?? 5,
        'subtitle' => 'Hacemos crecer tu marca con estrategias efectivas.',
        'description' => 'Plan de marketing digital con posicionamiento orgánico, optimización SEO avanzada, y campañas publicitarias personalizadas en redes sociales y Google Ads.',
        'conditions' => 'Incluye informes mensuales de resultados, Los costos publicitarios no están incluidos.',
        'image' => 'marketing.webp',
        'status' => 'Activo',
      ],
    ];


    foreach (array_merge($uniqueServices, $recurringServices) as $data) {
      Service::create($data);
    }
  }
}
