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
    ];

    protected $casts = [
        'precio' => 'decimal:2',
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
}
