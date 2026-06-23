<?php

namespace App\Services;

use App\Contracts\ParametrosEspecieProvider;
use App\Data\ParametrosEspecie;
use App\Models\Lago;
use Illuminate\Support\Collection;

class ParametrosEspecieDesdeEspecie implements ParametrosEspecieProvider
{
    public function obtenerPorLago(Lago $lago): Collection
    {
        $especie = $lago->especie;

        if (!$especie || !$especie->tieneParametrosIdeales()) {
            return collect();
        }

        return collect([
            new ParametrosEspecie(
                nombreEspecie: $especie->nombre,
                tempMin: (float) $especie->temp_min,
                tempMax: (float) $especie->temp_max,
                phMin: (float) $especie->ph_min,
                phMax: (float) $especie->ph_max,
                oxigenoMin: (float) $especie->oxigeno_min,
                oxigenoMax: (float) $especie->oxigeno_max,
            ),
        ]);
    }
}
