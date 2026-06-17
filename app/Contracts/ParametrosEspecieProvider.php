<?php

namespace App\Contracts;

use App\Data\ParametrosEspecie;
use App\Models\Lago;
use Illuminate\Support\Collection;

interface ParametrosEspecieProvider
{
    /** @return Collection<int, ParametrosEspecie> */
    public function obtenerPorLago(Lago $lago): Collection;
}
