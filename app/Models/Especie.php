<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'cantidad',
        'lago_id',
    ];

    public function lago()
    {
        return $this->belongsTo(Lago::class);
    }
}