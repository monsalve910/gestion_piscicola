<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reproduccion extends Model
{
    protected $table = 'reproducciones';

    protected $fillable = [
        'especie_id',
        'fecha',
        'cantidad',
        'observaciones'
    ];

    public function especie()
    {
        return $this->belongsTo(Especie::class);
    }
}