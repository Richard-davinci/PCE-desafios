<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            [
                'name' => 'Sitio Institucional',
                'category' => 'Desarrollo Web',
                'status' => 'Activo',
                'subtitle' => 'Ideal para pymes y profesionales',
                'description' => 'Diseño y desarrollo de un sitio web informativo con páginas básicas: Inicio, Nosotros, Servicios y Contacto.',
                'conditions' => null,
                'cover_image' => 'img/services/institucional-cover.webp',
                'thumb_image' => 'img/services/institucional-thumb.webp',
                'plans' => [
                    ['name' => 'Básico', 'price' => 149990, 'features' => ['Hosting 1 año', '1 dominio .com', 'Hasta 4 secciones']],
                    ['name' => 'Pro', 'price' => 199990, 'features' => ['Hosting 2 años', 'SEO básico', 'Blog integrado']],
                    ['name' => 'Premium', 'price' => 249990, 'features' => ['Integración con Analytics', 'Soporte mensual']],
                ],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Landing Page',
                'category' => 'Marketing Digital',
                'status' => 'Activo',
                'subtitle' => 'Página única optimizada para conversiones',
                'description' => 'Diseño de landing page moderna con formulario, llamadas a la acción y seguimiento de métricas.',
                'conditions' => null,
                'cover_image' => 'img/services/landing-cover.webp',
                'thumb_image' => 'img/services/landing-thumb.webp',
                'plans' => [
                    ['name' => 'One Page', 'price' => 99990, 'features' => ['Formulario de contacto', 'Enlace a redes', 'Dominio .com.ar']],
                    ['name' => 'Lead Pro', 'price' => 149990, 'features' => ['Optimización SEO', 'Integración con Mailchimp']],
                ],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tienda Online',
                'category' => 'E-commerce',
                'status' => 'Activo',
                'subtitle' => 'Solución completa para vender online',
                'description' => 'Desarrollo de tienda virtual con carrito, pasarela de pagos y gestión de productos.',
                'conditions' => null,
                'cover_image' => 'img/services/ecommerce-cover.webp',
                'thumb_image' => 'img/services/ecommerce-thumb.webp',
                'plans' => [
                    ['name' => 'Shop Básico', 'price' => 249990, 'features' => ['Hasta 50 productos', 'MercadoPago', 'Panel admin']],
                    ['name' => 'Shop Plus', 'price' => 329990, 'features' => ['Catálogo ilimitado', 'Descuentos y cupones']],
                ],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mantenimiento Web',
                'category' => 'Soporte Técnico',
                'status' => 'Activo',
                'subtitle' => 'Actualización y respaldo continuo de tu sitio',
                'description' => 'Plan de mantenimiento mensual con actualización de contenido, seguridad y copias de respaldo.',
                'conditions' => null,
                'cover_image' => 'img/services/mantenimiento-cover.webp',
                'thumb_image' => 'img/services/mantenimiento-thumb.webp',
                'plans' => [
                    ['name' => 'Mensual', 'price' => 29990, 'features' => ['Backups semanales', 'Actualizaciones menores']],
                    ['name' => 'Anual', 'price' => 299990, 'features' => ['Monitoreo 24/7', 'Soporte técnico incluido']],
                ],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Branding y Diseño',
                'category' => 'Diseño Gráfico',
                'status' => 'Activo',
                'subtitle' => 'Creación de marca profesional y diseño visual',
                'description' => 'Incluye logo, paleta de colores, tipografía y manual de marca.',
                'conditions' => null,
                'cover_image' => 'img/services/branding-cover.webp',
                'thumb_image' => 'img/services/branding-thumb.webp',
                'plans' => [
                    ['name' => 'Starter', 'price' => 89990, 'features' => ['Logo + paleta', '3 revisiones']],
                    ['name' => 'Full Brand', 'price' => 149990, 'features' => ['Manual de marca', 'Papelería digital']],
                ],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SEO y Posicionamiento',
                'category' => 'Marketing Digital',
                'status' => 'Activo',
                'subtitle' => 'Optimización para buscadores (Google, Bing)',
                'description' => 'Análisis técnico, investigación de palabras clave y estrategias de posicionamiento orgánico.',
                'conditions' => null,
                'cover_image' => 'img/services/seo-cover.webp',
                'thumb_image' => 'img/services/seo-thumb.webp',
                'plans' => [
                    ['name' => 'Auditoría', 'price' => 79990, 'features' => ['Reporte técnico', 'Recomendaciones SEO']],
                    ['name' => 'SEO Mensual', 'price' => 99990, 'features' => ['Optimización on-page', 'Link building básico']],
                ],
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
