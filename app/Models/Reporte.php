<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $fillable = [
        'titulo',
        'contenido',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
