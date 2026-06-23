<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'cantidad',
        'precio',
        'lago_id',
        'temp_min',
        'temp_max',
        'ph_min',
        'ph_max',
        'oxigeno_min',
        'oxigeno_max',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'temp_min' => 'decimal:2',
        'temp_max' => 'decimal:2',
        'ph_min' => 'decimal:2',
        'ph_max' => 'decimal:2',
        'oxigeno_min' => 'decimal:2',
        'oxigeno_max' => 'decimal:2',
    ];

    public function lago()
    {
        return $this->belongsTo(Lago::class);
    }

    public function reproducciones()
    {
        return $this->hasMany(Reproduccion::class);
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

    public function tieneParametrosIdeales(): bool
    {
        return $this->temp_min !== null
            && $this->temp_max !== null
            && $this->ph_min !== null
            && $this->ph_max !== null
            && $this->oxigeno_min !== null
            && $this->oxigeno_max !== null;
    }
}
