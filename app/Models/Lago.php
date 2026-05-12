<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lago extends Model
{
    public function especies()
    {
        return $this->hasMany(Especie::class);
    }

    public function recomendaciones()
    {
        return $this->hasMany(Recomendacion::class);
    }
}
