<?php

namespace Database\Seeders;

use App\Models\Monitoreo;
use Illuminate\Database\Seeder;

class MonitoreoSeeder extends Seeder
{
    public function run(): void
    {
        $monitoreos = [
            // Lago 1 - Esmeralda (mayormente saludable, algunos regulares)
            ['lago_id' => 1, 'fecha_monitoreo' => '2026-01-10', 'temperatura_agua' => 26.50, 'ph' => 7.20, 'nivel_oxigeno' => 6.50, 'estado_general' => 'bueno', 'observaciones' => 'Parámetros estables. Peces activos.'],
            ['lago_id' => 1, 'fecha_monitoreo' => '2026-01-25', 'temperatura_agua' => 27.00, 'ph' => 7.10, 'nivel_oxigeno' => 6.20, 'estado_general' => 'bueno', 'observaciones' => 'Sin novedades.'],
            ['lago_id' => 1, 'fecha_monitoreo' => '2026-02-10', 'temperatura_agua' => 28.20, 'ph' => 7.30, 'nivel_oxigeno' => 5.80, 'estado_general' => 'bueno', 'observaciones' => 'Alimentación normal.'],
            ['lago_id' => 1, 'fecha_monitoreo' => '2026-03-01', 'temperatura_agua' => 29.00, 'ph' => 7.00, 'nivel_oxigeno' => 5.50, 'estado_general' => 'regular', 'observaciones' => 'Oxígeno ligeramente bajo. Se activó aireación.'],
            ['lago_id' => 1, 'fecha_monitoreo' => '2026-03-20', 'temperatura_agua' => 31.20, 'ph' => 7.40, 'nivel_oxigeno' => 5.00, 'estado_general' => 'regular', 'observaciones' => 'Temperatura elevada por ola de calor.'],
            ['lago_id' => 1, 'fecha_monitoreo' => '2026-04-05', 'temperatura_agua' => 33.50, 'ph' => 7.60, 'nivel_oxigeno' => 4.20, 'estado_general' => 'malo', 'observaciones' => 'Temperatura crítica. Peces en superficie. Se reforzó aireación.'],

            // Lago 2 - Azul (estable, buenos parámetros)
            ['lago_id' => 2, 'fecha_monitoreo' => '2026-01-12', 'temperatura_agua' => 24.50, 'ph' => 6.80, 'nivel_oxigeno' => 7.00, 'estado_general' => 'bueno', 'observaciones' => 'Agua clara, buen estado.'],
            ['lago_id' => 2, 'fecha_monitoreo' => '2026-02-05', 'temperatura_agua' => 25.00, 'ph' => 6.90, 'nivel_oxigeno' => 6.80, 'estado_general' => 'bueno', 'observaciones' => 'Parámetros dentro de lo esperado.'],
            ['lago_id' => 2, 'fecha_monitoreo' => '2026-02-28', 'temperatura_agua' => 25.80, 'ph' => 7.00, 'nivel_oxigeno' => 6.50, 'estado_general' => 'bueno', 'observaciones' => 'Sin novedades.'],
            ['lago_id' => 2, 'fecha_monitoreo' => '2026-03-15', 'temperatura_agua' => 26.20, 'ph' => 6.70, 'nivel_oxigeno' => 5.80, 'estado_general' => 'bueno', 'observaciones' => 'Ligera variación de pH pero dentro del rango.'],
            ['lago_id' => 2, 'fecha_monitoreo' => '2026-04-10', 'temperatura_agua' => 27.00, 'ph' => 7.10, 'nivel_oxigeno' => 6.00, 'estado_general' => 'bueno', 'observaciones' => 'Todo en orden.'],

            // Lago 3 - Dorado (problemas de pH y oxígeno)
            ['lago_id' => 3, 'fecha_monitoreo' => '2026-01-08', 'temperatura_agua' => 28.00, 'ph' => 8.70, 'nivel_oxigeno' => 5.50, 'estado_general' => 'regular', 'observaciones' => 'pH alcalino. Se aplicó correctivo.'],
            ['lago_id' => 3, 'fecha_monitoreo' => '2026-01-22', 'temperatura_agua' => 28.50, 'ph' => 8.90, 'nivel_oxigeno' => 5.00, 'estado_general' => 'regular', 'observaciones' => 'pH continúa elevado.'],
            ['lago_id' => 3, 'fecha_monitoreo' => '2026-02-12', 'temperatura_agua' => 29.00, 'ph' => 9.00, 'nivel_oxigeno' => 4.50, 'estado_general' => 'malo', 'observaciones' => 'pH crítico y oxígeno bajo. Se necesita intervención urgente.'],
            ['lago_id' => 3, 'fecha_monitoreo' => '2026-03-05', 'temperatura_agua' => 30.50, 'ph' => 8.50, 'nivel_oxigeno' => 3.80, 'estado_general' => 'malo', 'observaciones' => 'Oxígeno por debajo del mínimo. Sistema de aireación al máximo.'],
            ['lago_id' => 3, 'fecha_monitoreo' => '2026-03-28', 'temperatura_agua' => 31.00, 'ph' => 8.60, 'nivel_oxigeno' => 4.00, 'estado_general' => 'regular', 'observaciones' => 'Mejora parcial del oxígeno.'],
            ['lago_id' => 3, 'fecha_monitoreo' => '2026-04-15', 'temperatura_agua' => 32.00, 'ph' => 8.80, 'nivel_oxigeno' => 3.50, 'estado_general' => 'malo', 'observaciones' => 'Alerta: múltiples parámetros fuera de rango.'],

            // Lago 4 - La Gloria (frío, buen estado)
            ['lago_id' => 4, 'fecha_monitoreo' => '2026-01-15', 'temperatura_agua' => 22.00, 'ph' => 6.50, 'nivel_oxigeno' => 7.50, 'estado_general' => 'bueno', 'observaciones' => 'Temperatura fresca, ideal para ciertas especies.'],
            ['lago_id' => 4, 'fecha_monitoreo' => '2026-02-08', 'temperatura_agua' => 21.50, 'ph' => 6.40, 'nivel_oxigeno' => 7.80, 'estado_general' => 'regular', 'observaciones' => 'pH ligeramente bajo.'],
            ['lago_id' => 4, 'fecha_monitoreo' => '2026-03-02', 'temperatura_agua' => 23.00, 'ph' => 6.20, 'nivel_oxigeno' => 7.00, 'estado_general' => 'regular', 'observaciones' => 'pH continúa bajo. Se recomienda monitoreo.'],
            ['lago_id' => 4, 'fecha_monitoreo' => '2026-04-01', 'temperatura_agua' => 24.00, 'ph' => 6.80, 'nivel_oxigeno' => 6.50, 'estado_general' => 'bueno', 'observaciones' => 'pH recuperándose.'],

            // Lago 5 - El Oasis (temperatura alta, buen oxígeno)
            ['lago_id' => 5, 'fecha_monitoreo' => '2026-01-18', 'temperatura_agua' => 29.00, 'ph' => 7.50, 'nivel_oxigeno' => 6.00, 'estado_general' => 'bueno', 'observaciones' => 'Parámetros normales.'],
            ['lago_id' => 5, 'fecha_monitoreo' => '2026-02-14', 'temperatura_agua' => 30.00, 'ph' => 7.80, 'nivel_oxigeno' => 5.50, 'estado_general' => 'bueno', 'observaciones' => 'Temperatura en límite superior.'],
            ['lago_id' => 5, 'fecha_monitoreo' => '2026-03-10', 'temperatura_agua' => 33.00, 'ph' => 8.00, 'nivel_oxigeno' => 5.00, 'estado_general' => 'regular', 'observaciones' => 'Temperatura por encima del rango óptimo.'],
            ['lago_id' => 5, 'fecha_monitoreo' => '2026-04-08', 'temperatura_agua' => 34.00, 'ph' => 8.10, 'nivel_oxigeno' => 4.80, 'estado_general' => 'malo', 'observaciones' => 'Temperatura crítica. Se activaron todos los sistemas de refrigeración.'],

            // Lago 6 - La Cascada (inactivo, pocos monitoreos históricos)
            ['lago_id' => 6, 'fecha_monitoreo' => '2026-01-05', 'temperatura_agua' => 25.00, 'ph' => 7.00, 'nivel_oxigeno' => 6.00, 'estado_general' => 'bueno', 'observaciones' => 'Último monitoreo antes de mantenimiento.'],
            ['lago_id' => 6, 'fecha_monitoreo' => '2026-02-20', 'temperatura_agua' => 24.00, 'ph' => 8.50, 'nivel_oxigeno' => 3.00, 'estado_general' => 'malo', 'observaciones' => 'pH alcalino, oxígeno crítico. Lago en mantenimiento.'],
        ];

        foreach ($monitoreos as $monitoreo) {
            Monitoreo::create($monitoreo);
        }

        $this->command->info('28 monitoreos creados correctamente.');
    }
}
