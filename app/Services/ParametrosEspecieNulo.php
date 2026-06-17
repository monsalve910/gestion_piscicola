<?php

namespace App\Services;

use App\Contracts\ParametrosEspecieProvider;
use App\Data\ParametrosEspecie;
use App\Models\Lago;
use Illuminate\Support\Collection;

class ParametrosEspecieNulo implements ParametrosEspecieProvider
{
    public function obtenerPorLago(Lago $lago): Collection
    {
        return collect();
    }
}
