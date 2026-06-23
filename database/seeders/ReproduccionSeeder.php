<?php

namespace Database\Seeders;

use App\Models\Reproduccion;
use Illuminate\Database\Seeder;

class ReproduccionSeeder extends Seeder
{
    public function run(): void
    {
        $reproducciones = [
            ['especie_id' => 1, 'fecha' => '2026-01-20', 'cantidad' => 500, 'observaciones' => 'Primera reproducción del año. Buen resultado.'],
            ['especie_id' => 1, 'fecha' => '2026-02-25', 'cantidad' => 650, 'observaciones' => 'Aumento en la tasa de reproducción.'],
            ['especie_id' => 2, 'fecha' => '2026-01-22', 'cantidad' => 400, 'observaciones' => 'Reproducción estable.'],
            ['especie_id' => 2, 'fecha' => '2026-03-10', 'cantidad' => 550, 'observaciones' => 'Mejora en condiciones del agua.'],
            ['especie_id' => 3, 'fecha' => '2026-02-01', 'cantidad' => 200, 'observaciones' => 'Reproducción de cachama en lago profundo.'],
            ['especie_id' => 4, 'fecha' => '2026-01-28', 'cantidad' => 350, 'observaciones' => 'Buena tasa de reproducción de mojarra.'],
            ['especie_id' => 4, 'fecha' => '2026-03-15', 'cantidad' => 420, 'observaciones' => 'Segunda camada del trimestre.'],
            ['especie_id' => 5, 'fecha' => '2026-02-10', 'cantidad' => 100, 'observaciones' => 'Reproducción controlada de carpa.'],
            ['especie_id' => 6, 'fecha' => '2026-03-05', 'cantidad' => 180, 'observaciones' => 'Reproducción exitosa de bocachico.'],
            ['especie_id' => 7, 'fecha' => '2026-01-15', 'cantidad' => 600, 'observaciones' => 'Alta tasa de reproducción de tilapia gris.'],
            ['especie_id' => 7, 'fecha' => '2026-02-28', 'cantidad' => 750, 'observaciones' => 'Récord de reproducción del semestre.'],
            ['especie_id' => 8, 'fecha' => '2026-03-20', 'cantidad' => 80, 'observaciones' => 'Reproducción de yamú en proceso de prueba.'],
        ];

        foreach ($reproducciones as $rep) {
            Reproduccion::create($rep);
        }

        $this->command->info('12 reproducciones creadas correctamente.');
    }
}
