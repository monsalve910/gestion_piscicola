<?php

namespace Database\Seeders;

use App\Models\Especie;
use Illuminate\Database\Seeder;

class EspecieSeeder extends Seeder
{
    public function run(): void
    {
        $especies = [
            ['nombre' => 'Tilapia Roja', 'descripcion' => 'Variedad de tilapia de crecimiento rápido y alta resistencia.', 'cantidad' => 1500, 'precio' => 8500.00, 'lago_id' => 1, 'temp_min' => 24, 'temp_max' => 30, 'ph_min' => 6.5, 'ph_max' => 8.5, 'oxigeno_min' => 4, 'oxigeno_max' => 8],
            ['nombre' => 'Tilapia Nilótica', 'descripcion' => 'Tilapia de origen africano, ideal para climas cálidos.', 'cantidad' => 2000, 'precio' => 7800.00, 'lago_id' => 1, 'temp_min' => 22, 'temp_max' => 32, 'ph_min' => 6.0, 'ph_max' => 9.0, 'oxigeno_min' => 3, 'oxigeno_max' => 7],
            ['nombre' => 'Cachama Blanca', 'descripcion' => 'Especie nativa de alto valor comercial y carne apreciada.', 'cantidad' => 800, 'precio' => 12000.00, 'lago_id' => 2, 'temp_min' => 22, 'temp_max' => 28, 'ph_min' => 5.5, 'ph_max' => 7.5, 'oxigeno_min' => 4, 'oxigeno_max' => 9],
            ['nombre' => 'Mojarra Roja', 'descripcion' => 'Variedad de mojarra de excelente sabor y resistencia.', 'cantidad' => 1200, 'precio' => 9500.00, 'lago_id' => 3, 'temp_min' => 23, 'temp_max' => 29, 'ph_min' => 6.0, 'ph_max' => 8.0, 'oxigeno_min' => 3.5, 'oxigeno_max' => 7.5],
            ['nombre' => 'Carpa Espejo', 'descripcion' => 'Carpa de gran tamaño, ideal para lagos profundos.', 'cantidad' => 500, 'precio' => 15000.00, 'lago_id' => 2, 'temp_min' => 12, 'temp_max' => 20, 'ph_min' => 6.8, 'ph_max' => 8.0, 'oxigeno_min' => 5, 'oxigeno_max' => 9],
            ['nombre' => 'Bocachico', 'descripcion' => 'Pez nativo colombiano, muy apreciado en la región.', 'cantidad' => 600, 'precio' => 11000.00, 'lago_id' => 3, 'temp_min' => 22, 'temp_max' => 30, 'ph_min' => 6.0, 'ph_max' => 8.5, 'oxigeno_min' => 4, 'oxigeno_max' => 8],
            ['nombre' => 'Tilapia Gris', 'descripcion' => 'Variedad de tilapia de alta productividad y resistencia a enfermedades.', 'cantidad' => 1800, 'precio' => 7200.00, 'lago_id' => 4, 'temp_min' => 24, 'temp_max' => 30, 'ph_min' => 6.5, 'ph_max' => 8.5, 'oxigeno_min' => 4, 'oxigeno_max' => 8],
            ['nombre' => 'Yamú', 'descripcion' => 'Especie nativa de gran tamaño y alto valor en el mercado.', 'cantidad' => 300, 'precio' => 18000.00, 'lago_id' => 5, 'temp_min' => 22, 'temp_max' => 28, 'ph_min' => 6.0, 'ph_max' => 8.0, 'oxigeno_min' => 4.5, 'oxigeno_max' => 9],
        ];

        foreach ($especies as $especie) {
            Especie::create($especie);
        }

        $this->command->info('8 especies creadas correctamente.');
    }
}
