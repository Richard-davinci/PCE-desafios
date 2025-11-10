<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class PlanSeeder extends Seeder
{
  public function run(): void
  {
    $services = Service::orderBy('id')->get();

    foreach ($services as $index => $service) {

      // No crear planes para servicios en estado "Borrador"
      if ($service->status === 'Borrador') {
        continue;
      }

      // ==============================
      // PRIMEROS 4 SERVICIOS: PLAN ÚNICO
      // ==============================
      if ($index < 4) {

        if ($service->name === 'Landing Page Profesional (WordPress)') {
          $price = 49;
          $features = [
            'Landing de una sola sección con diseño moderno',
            'Formulario de contacto integrado',
            'Integración con WhatsApp o email',
            'Diseño responsive preparado para campañas',
          ];
        } elseif ($service->name === 'Sitio Web One Page Profesional') {
          $price = 69;
          $features = [
            'Estructura one page con secciones: inicio, servicios, sobre mí, contacto',
            'Scroll fluido y diseño visual atractivo',
            'Optimización básica de carga',
            'Diseño responsive',
          ];
        } elseif ($service->name === 'Sitio Web Institucional / Corporativo') {
          $price = 119;
          $features = [
            '4 a 6 secciones institucionales (inicio, empresa, servicios, contacto)',
            'Formulario de contacto',
            'Integración con redes sociales',
            'Diseño adaptable a la identidad de la empresa',
          ];
        } else {
          // Cualquier otro que caiga en los primeros 4 y no matchee exacto
          $price = 79;
          $features = [
            'Implementación única del sitio',
            'Diseño responsive',
          ];
        }

        $service->plans()->create([
          'name'     => 'Único',
          'type'     => 'único',
          'price'    => $price,
          'features' => $features,
        ]);

        continue;
      }

      // =======================================
      // RESTO DE SERVICIOS: PLANES MENSUALES + ANUALES
      // =======================================

      // Precios base por servicio (por tier)
      if ($service->name === 'Tienda Online Inicial') {
        $monthlyBase = [
          'Básico'      => 20,
          'Pro'         => 35,
          'Empresarial' => 55,
        ];
      } elseif ($service->name === 'Tienda Online Profesional') {
        $monthlyBase = [
          'Básico'      => 25,
          'Pro'         => 45,
          'Empresarial' => 70,
        ];
      } elseif ($service->name === 'Mantenimiento Web & Soporte') {
        $monthlyBase = [
          'Básico'      => 10,
          'Pro'         => 18,
          'Empresarial' => 29,
        ];
      } elseif ($service->name === 'Gestión de Hosting y Dominio') {
        $monthlyBase = [
          'Básico'      => 8,
          'Pro'         => 15,
          'Empresarial' => 25,
        ];
      } elseif ($service->name === 'Seguridad & Backups Premium') {
        $monthlyBase = [
          'Básico'      => 12,
          'Pro'         => 20,
          'Empresarial' => 32,
        ];
      } elseif ($service->name === 'Marketing Digital y SEO') {
        $monthlyBase = [
          'Básico'      => 40,
          'Pro'         => 70,
          'Empresarial' => 120,
        ];
      } elseif ($service->name === 'Branding Visual Corporativo') {
        $monthlyBase = [
          'Básico'      => 30,
          'Pro'         => 55,
          'Empresarial' => 90,
        ];
      } else {
        // Fallback genérico si sumás nuevos servicios recurrentes
        $monthlyBase = [
          'Básico'      => 15,
          'Pro'         => 25,
          'Empresarial' => 40,
        ];
      }

      foreach ($monthlyBase as $name => $monthly) {

        // ============================
        // FEATURES MENSUALES ESCALONADOS SEGÚN SERVICIO
        // ============================

        // Tienda Online Inicial / Profesional
        if ($service->name === 'Tienda Online Inicial' || $service->name === 'Tienda Online Profesional') {

          if ($name === 'Básico') {
            $featuresMensual = [
              'Soporte por mail/WhatsApp en horario comercial',
              'Ajustes menores en textos e imágenes',
              'Monitoreo básico de disponibilidad',
            ];
          } elseif ($name === 'Pro') {
            $featuresMensual = [
              'Todo lo incluido en Básico',
              'Actualización mensual de productos seleccionados',
              'Revisión básica de checkout y medios de pago',
            ];
          } else { // Empresarial
            $featuresMensual = [
              'Todo lo incluido en Pro',
              'Soporte prioritario',
              'Optimización de secciones clave de conversión',
              'Reportes simples de rendimiento mensual',
            ];
          }

          // Mantenimiento Web & Soporte
        } elseif ($service->name === 'Mantenimiento Web & Soporte') {

          if ($name === 'Básico') {
            $featuresMensual = [
              'Actualizaciones de núcleo y plugins',
              'Backups mensuales',
              'Corrección de errores menores',
            ];
          } elseif ($name === 'Pro') {
            $featuresMensual = [
              'Todo lo incluido en Básico',
              'Backups semanales',
              'Monitoreo básico de seguridad',
            ];
          } else { // Empresarial
            $featuresMensual = [
              'Todo lo incluido en Pro',
              'Backups diarios',
              'Respuesta prioritaria ante incidentes',
              'Ajustes básicos de performance',
            ];
          }

          // Gestión de Hosting y Dominio
        } elseif ($service->name === 'Gestión de Hosting y Dominio') {

          if ($name === 'Básico') {
            $featuresMensual = [
              'Configuración inicial de hosting y dominio',
              'Soporte para DNS básico',
              'Monitoreo de estado del servidor',
            ];
          } elseif ($name === 'Pro') {
            $featuresMensual = [
              'Todo lo incluido en Básico',
              'Gestión de certificados SSL',
              'Backups del servidor según disponibilidad',
            ];
          } else { // Empresarial
            $featuresMensual = [
              'Todo lo incluido en Pro',
              'Optimización de recursos del servidor',
              'Asistencia avanzada en migraciones y configuración',
            ];
          }

          // Seguridad & Backups Premium
        } elseif ($service->name === 'Seguridad & Backups Premium') {

          if ($name === 'Básico') {
            $featuresMensual = [
              'Backups automáticos periódicos',
              'Monitoreo básico de integridad',
            ];
          } elseif ($name === 'Pro') {
            $featuresMensual = [
              'Todo lo incluido en Básico',
              'Backups más frecuentes',
              'Alertas ante actividad sospechosa',
            ];
          } else { // Empresarial
            $featuresMensual = [
              'Todo lo incluido en Pro',
              'Backups diarios',
              'Soporte prioritario en incidentes críticos',
            ];
          }

          // Marketing Digital y SEO
        } elseif ($service->name === 'Marketing Digital y SEO') {

          if ($name === 'Básico') {
            $featuresMensual = [
              'Optimización SEO on-page básica',
              'Gestión simple de redes sociales',
              'Reporte mensual resumido',
            ];
          } elseif ($name === 'Pro') {
            $featuresMensual = [
              'Todo lo incluido en Básico',
              'Gestión de campañas pagas básicas',
              'Reporte mensual detallado con métricas clave',
            ];
          } else { // Empresarial
            $featuresMensual = [
              'Todo lo incluido en Pro',
              'Estrategia avanzada de SEO y contenidos',
              'Optimización continua de campañas',
            ];
          }

          // Branding Visual Corporativo
        } elseif ($service->name === 'Branding Visual Corporativo') {

          if ($name === 'Básico') {
            $featuresMensual = [
              'Soporte para uso correcto del logo y paleta',
              'Ajustes menores en piezas existentes',
            ];
          } elseif ($name === 'Pro') {
            $featuresMensual = [
              'Todo lo incluido en Básico',
              'Diseño mensual de piezas simples (banners/redes)',
            ];
          } else { // Empresarial
            $featuresMensual = [
              'Todo lo incluido en Pro',
              'Soporte prioritario de marca',
              'Diseño de piezas adicionales según necesidad',
            ];
          }

          // Fallback genérico coherente
        } else {

          if ($name === 'Básico') {
            $featuresMensual = [
              'Soporte por mail/WhatsApp',
              'Ajustes menores incluidos',
            ];
          } elseif ($name === 'Pro') {
            $featuresMensual = [
              'Todo lo incluido en Básico',
              'Mejor tiempo de respuesta',
              '1 cambio mensual incluido',
            ];
          } else { // Empresarial
            $featuresMensual = [
              'Todo lo incluido en Pro',
              'Soporte prioritario',
              'Hasta 3 cambios mensuales incluidos',
            ];
          }
        }

        // ========= PLAN MENSUAL =========
        $service->plans()->create([
          'name'     => $name,
          'type'     => 'mensual',
          'price'    => $monthly,
          'features' => $featuresMensual,
        ]);

        // ========= PLAN ANUAL =========
        if ($name === 'Básico') {
          $discount = 10;
        } elseif ($name === 'Pro') {
          $discount = 15;
        } elseif ($name === 'Empresarial') {
          $discount = 20;
        } else {
          $discount = 10;
        }

        $annualBase  = $monthly * 12;
        $annualFinal = round($annualBase * (1 - $discount / 100), 2);

        // Mismo contenido que el mensual
        $featuresAnual = $featuresMensual;

        $service->plans()->create([
          'name'     => $name,
          'type'     => 'anual',
          'price'    => $annualFinal,
          'discount' => $discount,
          'features' => $featuresAnual,
        ]);
      }
    }
  }
}
