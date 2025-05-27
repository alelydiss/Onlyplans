<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'events_id',
        'numero',
        'zona',
        'estado',
    ];

    // Relación con el evento
    public function evento()
    {
        return $this->belongsTo(Event::class);
    }
}
