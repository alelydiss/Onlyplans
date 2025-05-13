<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'event_id', 'nombre', 'correo', 'telefono', 'cantidad', 'zona', 'total',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
