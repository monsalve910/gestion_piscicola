<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monitoreo extends Model
{
    protected $fillable = [
        'lago_id',
        'fecha_monitoreo',
        'temperatura_agua',
        'ph',
        'nivel_oxigeno',
        'estado_general',
        'observaciones',
    ];

    protected function casts(): array
    {
        return [
            'fecha_monitoreo' => 'date',
            'temperatura_agua' => 'decimal:2',
            'ph' => 'decimal:2',
            'nivel_oxigeno' => 'decimal:2',
        ];
    }

    public function lago()
    {
        return $this->belongsTo(Lago::class);
    }
}
