<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividads'; // nombre de la tabla, Laravel por convención usa el plural inglés

    public $timestamps = false; // si tu tabla no tiene created_at y updated_at
    protected $dates = ['fecha'];

    protected $fillable = [
        'descripcion',
        'icono',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];
}