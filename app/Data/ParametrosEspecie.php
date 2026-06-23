<?php

namespace App\Data;

class ParametrosEspecie
{
    public function __construct(
        public readonly string $nombreEspecie,
        public readonly ?float $tempMin = null,
        public readonly ?float $tempMax = null,
        public readonly ?float $phMin = null,
        public readonly ?float $phMax = null,
        public readonly ?float $oxigenoMin = null,
        public readonly ?float $oxigenoMax = null,
    ) {}
}
