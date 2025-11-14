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

    // ============================
    // SERVICIOS DE PLAN ÚNICO
    // ============================
    $uniqueServices = [
      [
        'name'        => 'Landing Page Profesional (WordPress)',
        'category_id' => $categories['Desarrollo Web']
          ?? $categories['Landing Pages & WordPress']
            ?? 1,
        'subtitle'    => 'Landing moderna de una sola página, ideal para campañas o servicios puntuales.',
        'description' => 'Incluye sección principal, llamado a la acción, formulario de contacto, integración con WhatsApp y diseño responsive.',
        'conditions'  => 'Entrega estimada entre 5 y 7 días hábiles, 1 ronda de ajustes incluida, ideal para campañas puntuales, integración básica con analíticas',
        'image'       => 'landing-wp-pro.webp',
        'status'      => 'Activo',
      ],
      [
        'name'        => 'Sitio Web One Page Profesional',
        'category_id' => $categories['Desarrollo Web'] ?? 1,
        'subtitle'    => 'Sitio tipo scroll largo con todas las secciones esenciales en una sola página.',
        'description' => 'Perfecto para profesionales y marcas personales. Secciones de inicio, servicios, sobre mí, testimonios y contacto.',
        'conditions'  => 'Diseño adaptable, enfoque visual moderno, carga rápida, optimizada para dispositivos móviles',
        'image'       => 'onepage-pro.webp',
        'status'      => 'Activo',
      ],
      [
        'name'        => 'Sitio Web Institucional / Corporativo',
        'category_id' => $categories['Sitios Web Institucionales']
          ?? $categories['Desarrollo Web']
            ?? 1,
        'subtitle'    => 'Sitio multi-sección para empresas y organizaciones.',
        'description' => 'Incluye secciones de empresa, servicios, equipo, contacto y opcionalmente blog básico.',
        'conditions'  => 'Ideal para PyMEs y profesionales, estructura multi-sección, imagen corporativa consistente, preparado para crecer a futuro',
        'image'       => 'web-institucional.webp',
        'status'      => 'Activo',
      ],
      [
        'name'        => 'Sitio Web Completo Empresarial',
        'category_id' => $categories['Desarrollo Web'] ?? 1,
        'subtitle'    => 'Versión avanzada con más secciones, blog, recursos y analíticas.',
        'description' => 'Pensado para empresas con mayor volumen de contenido: noticias, casos de éxito, múltiples servicios y formularios avanzados.',
        'conditions'  => 'Incluye integración con analíticas, optimización inicial para SEO, pensado para grandes volúmenes de contenido, orientado a empresas en crecimiento',
        'image'       => 'web-empresarial.webp',
        'status'      => 'Borrador', // No genera planes (según PlanSeeder)
      ],
    ];

    // ==================================
    // SERVICIOS MENSUALES
    // ==================================
    $recurringServices = [
      [
        'name'        => 'Tienda Online Inicial',
        'category_id' => $categories['Tiendas Online']
          ?? $categories['Desarrollo Web']
            ?? 1,
        'subtitle'    => 'E-commerce funcional para empezar a vender online.',
        'description' => 'Incluye catálogo inicial acotado, carrito, medios de pago integrados y diseño responsive.',
        'conditions'  => 'Pensado para pequeños emprendimientos, catálogo inicial acotado, escalable a planes superiores, ideal como primer e-commerce',
        'image'       => 'tienda-inicial.webp',
        'status'      => 'Pausado',
      ],
      [
        'name'        => 'Tienda Online Profesional',
        'category_id' => $categories['Tiendas Online']
          ?? $categories['Desarrollo Web']
            ?? 1,
        'subtitle'    => 'E-commerce avanzado y escalable para catálogos más grandes.',
        'description' => 'Incluye filtros, cupones, múltiples medios de pago, secciones personalizadas y enfoque en conversión.',
        'conditions'  => 'Ideal para marcas con alto volumen de productos, preparado para campañas activas, pensado para escalar, orientado a maximizar conversiones',
        'image'       => 'tienda-pro.webp',
        'status'      => 'Activo',
      ],
      [
        'name'        => 'Mantenimiento Web & Soporte',
        'category_id' => $categories['Mantenimiento Web']
          ?? $categories['Soporte Técnico']
            ?? 1,
        'subtitle'    => 'Planes para mantener tu sitio seguro, actualizado y funcionando.',
        'description' => 'Incluye actualizaciones, backups, monitoreo básico, pequeñas correcciones y soporte técnico según el plan.',
        'conditions'  => 'Servicio mensual o anual, sin permanencia obligatoria, ideal para sitios en producción, previene caídas y problemas técnicos',
        'image'       => 'mant-web-soporte.webp',
        'status'      => 'Activo',
      ],
      [
        'name'        => 'Gestión de Hosting y Dominio',
        'category_id' => $categories['Infraestructura']
          ?? $categories['Soporte Técnico']
            ?? 1,
        'subtitle'    => 'Nos encargamos del hosting y dominio para que el cliente no se preocupe.',
        'description' => 'Configuración, migración, seguridad básica, renovaciones, monitoreo y soporte técnico.',
        'conditions'  => 'Gestión continua, ideal para clientes no técnicos, incluye monitoreo y renovaciones, recomendado para proyectos en producción',
        'image'       => 'hosting-dominio.webp',
        'status'      => 'Activo',
      ],
      [
        'name'        => 'Seguridad & Backups Premium',
        'category_id' => $categories['Infraestructura']
          ?? $categories['Soporte Técnico']
            ?? 1,
        'subtitle'    => 'Protección avanzada y copias de seguridad frecuentes.',
        'description' => 'Backups automatizados, verificación de integridad, monitoreo de actividad sospechosa y recuperación ante incidentes.',
        'conditions'  => 'Recomendado para tiendas online y sitios con datos sensibles, copias de seguridad frecuentes, monitoreo de actividad sospechosa, recuperación ante incidentes, refuerzo de seguridad del servidor',
        'image'       => 'seguridad-backups.webp',
        'status'      => 'Pausado',
      ],
      [
        'name'        => 'Marketing Digital y SEO',
        'category_id' => $categories['Marketing Digital'] ?? 1,
        'subtitle'    => 'Impulsa la visibilidad y las conversiones de la marca.',
        'description' => 'Incluye SEO on-page, campañas en redes sociales, anuncios y reportes mensuales.',
        'conditions'  => 'Incluye SEO on-page básico, reportes periódicos de rendimiento, enfoque en posicionamiento y conversiones, los costos publicitarios se cotizan por separado',
        'image'       => 'marketing-seo.webp',
        'status'      => 'Activo',
      ],
      [
        'name'        => 'Diseño UX/UI Profesional',
        'category_id' => $categories['Diseño & Branding']
          ?? $categories['Diseño Gráfico']
            ?? 1,
        'subtitle'    => 'Experiencia de usuario y diseño de interfaz enfocados en conversión.',
        'description' => 'Wireframes, prototipos y diseño visual para sitios y aplicaciones.',
        'conditions'  => 'Ideal para proyectos a medida, mejora de plataformas existentes, enfoque en experiencia de usuario, pensado para aumentar conversiones',
        'image'       => 'ux-ui.webp',
        'status'      => 'Borrador', // No genera planes por estar en borrador
      ],
      [
        'name'        => 'Branding Visual Corporativo',
        'category_id' => $categories['Diseño & Branding']
          ?? $categories['Diseño Gráfico']
            ?? 1,
        'subtitle'    => 'Identidad visual completa alineada a la marca.',
        'description' => 'Logotipo, paleta de colores, tipografías, aplicaciones y lineamientos visuales.',
        'conditions'  => 'Pack ideal para nuevos emprendimientos, útil para procesos de rebranding, garantiza coherencia visual, pensado para uso en web y redes',
        'image'       => 'branding-corporativo.webp',
        'status'      => 'Activo',
      ],
    ];

    foreach (array_merge($uniqueServices, $recurringServices) as $data) {
      Service::create($data);
    }
  }
}
