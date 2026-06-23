<?php

namespace Database\Seeders;

use App\Models\Reporte;
use Illuminate\Database\Seeder;

class ReporteSeeder extends Seeder
{
    public function run(): void
    {
        $reportes = [
            [
                'titulo' => 'Reporte Mensual - Enero 2026',
                'contenido' => 'Durante el mes de enero se realizaron monitoreos regulares en todos los lagos activos. Los parámetros se mantuvieron estables en la mayoría de los casos. Se registró una reproducción exitosa de tilapia roja con 500 alevinos. Las ventas del mes alcanzaron los $1.740.000.',
                'user_id' => 1,
            ],
            [
                'titulo' => 'Reporte de Calidad de Agua - Febrero 2026',
                'contenido' => 'Se detectaron problemas de pH en el Lago Dorado con lecturas de hasta 9.0. Se aplicaron correctivos y se está monitoreando la evolución. El Lago Esmeralda y Lago Azul mantuvieron parámetros óptimos durante todo el mes.',
                'user_id' => 2,
            ],
            [
                'titulo' => 'Reporte de Producción - Primer Trimestre 2026',
                'contenido' => 'El primer trimestre del año mostró una producción total de 4.780 alevinos entre todas las especies. La tilapia gris en el Lago La Gloria tuvo la mayor tasa de reproducción con 1.350 alevinos en dos ciclos. Las ventas totales del trimestre alcanzaron los $8.566.500.',
                'user_id' => 1,
            ],
            [
                'titulo' => 'Alerta Sanitaria - Lago Dorado',
                'contenido' => 'El Lago Dorado presenta múltiples parámetros fuera de rango: temperatura elevada (32°C), pH alcalino (8.8) y oxígeno crítico (3.5 mg/L). Se recomienda intervención urgente con sistemas de aireación, correctores de pH y reducción de carga orgánica.',
                'user_id' => 3,
            ],
            [
                'titulo' => 'Reporte de Mantenimiento - Lago La Cascada',
                'contenido' => 'El Lago La Cascada se encuentra inactivo por trabajos de mantenimiento programados. Se están reforzando los bordes y limpiando el sistema de drenaje. Se espera reapertura para el próximo mes.',
                'user_id' => 2,
            ],
        ];

        foreach ($reportes as $reporte) {
            Reporte::create($reporte);
        }

        $this->command->info('5 reportes creados correctamente.');
    }
}
