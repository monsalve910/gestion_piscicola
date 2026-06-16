<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lago extends Model
{
    protected $fillable = [
        'nombre',
        'ubicacion',
        'tamano',
        'profundidad',
        'capacidad_maxima_peces',
        'estado',
        'observaciones',
    ];

    protected function casts(): array
    {
        return [
            'tamano' => 'decimal:2',
            'profundidad' => 'decimal:2',
            'capacidad_maxima_peces' => 'integer',
        ];
    }

    public function esActivo(): bool
    {
        return $this->estado === 'activo';
    }

    public function especies()
    {
        return $this->hasMany(Especie::class);
    }

    public function recomendaciones()
    {
        return $this->hasMany(Recomendacion::class);
    }

    public function monitoreos()
    {
        return $this->hasMany(Monitoreo::class);
    }
}
