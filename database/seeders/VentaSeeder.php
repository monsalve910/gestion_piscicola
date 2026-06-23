<?php

namespace Database\Seeders;

use App\Models\Venta;
use Illuminate\Database\Seeder;

class VentaSeeder extends Seeder
{
    public function run(): void
    {
        $ventas = [
            ['especie_id' => 1, 'peso_kg' => 120.00, 'precio_unitario' => 8500.00, 'total' => 1020000.00, 'fecha_venta' => '2026-02-05'],
            ['especie_id' => 1, 'peso_kg' => 85.00, 'precio_unitario' => 8500.00, 'total' => 722500.00, 'fecha_venta' => '2026-03-12'],
            ['especie_id' => 2, 'peso_kg' => 150.00, 'precio_unitario' => 7800.00, 'total' => 1170000.00, 'fecha_venta' => '2026-02-18'],
            ['especie_id' => 2, 'peso_kg' => 200.00, 'precio_unitario' => 7800.00, 'total' => 1560000.00, 'fecha_venta' => '2026-04-01'],
            ['especie_id' => 3, 'peso_kg' => 60.00, 'precio_unitario' => 12000.00, 'total' => 720000.00, 'fecha_venta' => '2026-01-30'],
            ['especie_id' => 3, 'peso_kg' => 45.00, 'precio_unitario' => 12000.00, 'total' => 540000.00, 'fecha_venta' => '2026-03-20'],
            ['especie_id' => 4, 'peso_kg' => 90.00, 'precio_unitario' => 9500.00, 'total' => 855000.00, 'fecha_venta' => '2026-02-22'],
            ['especie_id' => 5, 'peso_kg' => 35.00, 'precio_unitario' => 15000.00, 'total' => 525000.00, 'fecha_venta' => '2026-03-08'],
            ['especie_id' => 7, 'peso_kg' => 110.00, 'precio_unitario' => 7200.00, 'total' => 792000.00, 'fecha_venta' => '2026-02-14'],
            ['especie_id' => 7, 'peso_kg' => 95.00, 'precio_unitario' => 7200.00, 'total' => 684000.00, 'fecha_venta' => '2026-04-05'],
            ['especie_id' => 8, 'peso_kg' => 25.00, 'precio_unitario' => 18000.00, 'total' => 450000.00, 'fecha_venta' => '2026-03-25'],
        ];

        foreach ($ventas as $venta) {
            Venta::create($venta);
        }

        $this->command->info('11 ventas creadas correctamente.');
    }
}
