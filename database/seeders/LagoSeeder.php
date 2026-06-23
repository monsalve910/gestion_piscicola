<?php

namespace Database\Seeders;

use App\Models\Lago;
use Illuminate\Database\Seeder;

class LagoSeeder extends Seeder
{
    public function run(): void
    {
        $lagos = [
            [
                'nombre' => 'Lago Esmeralda',
                'ubicacion' => 'Sector Norte, Finca El Recuerdo',
                'tamano' => 2500.00,
                'profundidad' => 3.50,
                'capacidad_maxima_peces' => 5000,
                'estado' => 'activo',
                'observaciones' => 'Lago principal con buena exposición solar. Sistema de aireación instalado.',
            ],
            [
                'nombre' => 'Lago Azul',
                'ubicacion' => 'Sector Este, Finca El Recuerdo',
                'tamano' => 1800.00,
                'profundidad' => 4.20,
                'capacidad_maxima_peces' => 3500,
                'estado' => 'activo',
                'observaciones' => 'Lago profundo ideal para especies de agua fría.',
            ],
            [
                'nombre' => 'Lago Dorado',
                'ubicacion' => 'Sector Oeste, Finca El Recuerdo',
                'tamano' => 3200.00,
                'profundidad' => 2.80,
                'capacidad_maxima_peces' => 7000,
                'estado' => 'activo',
                'observaciones' => 'Lago más grande de la finca. Alta capacidad de producción.',
            ],
            [
                'nombre' => 'Lago La Gloria',
                'ubicacion' => 'Sector Sur, Finca El Recuerdo',
                'tamano' => 1200.00,
                'profundidad' => 3.00,
                'capacidad_maxima_peces' => 2500,
                'estado' => 'activo',
                'observaciones' => 'Lago en proceso de expansión. Buen potencial de crecimiento.',
            ],
            [
                'nombre' => 'Lago El Oasis',
                'ubicacion' => 'Sector Central, Finca El Porvenir',
                'tamano' => 2000.00,
                'profundidad' => 3.80,
                'capacidad_maxima_peces' => 4000,
                'estado' => 'activo',
                'observaciones' => 'Lago con sistema de recirculación de agua.',
            ],
            [
                'nombre' => 'Lago La Cascada',
                'ubicacion' => 'Sector Alto, Finca El Porvenir',
                'tamano' => 900.00,
                'profundidad' => 2.50,
                'capacidad_maxima_peces' => 1800,
                'estado' => 'inactivo',
                'observaciones' => 'Lago en mantenimiento por temporada de lluvias.',
            ],
        ];

        foreach ($lagos as $lago) {
            Lago::create($lago);
        }

        $this->command->info('6 lagos creados correctamente.');
    }
}
