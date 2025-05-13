<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'titulo',
        'fecha_inicio',
        'fecha_fin',
        'hora_inicio',
        'hora_fin',
        'tipo_evento',
        'precio',
        'descripcion',
        'ubicacion',
        'lat',
        'lng',
        'banner',
    ];

public function category()
{
    return $this->belongsTo(Categoria::class, 'category_id');
}
}
