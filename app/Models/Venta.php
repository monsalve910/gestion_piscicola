<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = [
        'especie_id',
        'peso_kg',
        'precio_unitario',
        'total',
        'fecha_venta',
    ];

    protected $casts = [
        'fecha_venta' => 'date',
        'peso_kg' => 'decimal:2',
        'precio_unitario' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function especie()
    {
        return $this->belongsTo(Especie::class);
    }
}
