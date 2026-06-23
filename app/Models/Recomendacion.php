<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recomendacion extends Model
{
    protected $table = 'recomendaciones';

    protected $fillable = [
        'lago_id',
        'mensaje',
        'tipo',
        'nivel_riesgo',
        'parametros',
        'es_actual',
    ];

    protected function casts(): array
    {
        return [
            'parametros' => 'array',
            'es_actual' => 'boolean',
        ];
    }

    public function lago()
    {
        return $this->belongsTo(Lago::class);
    }

    public function esAdvertencia(): bool
    {
        return $this->tipo === 'advertencia';
    }

    public function esAlerta(): bool
    {
        return $this->tipo === 'alerta';
    }

    public function esRecomendacion(): bool
    {
        return $this->tipo === 'recomendacion';
    }

    public function esInformacion(): bool
    {
        return $this->tipo === 'informacion';
    }

    public function getColorClase(): string
    {
        return match ($this->tipo) {
            'alerta' => 'red',
            'advertencia' => 'amber',
            'recomendacion' => 'blue',
            default => 'green',
        };
    }
}
