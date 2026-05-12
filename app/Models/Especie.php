<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
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
