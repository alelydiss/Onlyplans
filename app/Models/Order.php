<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'event_id', 'nombre', 'correo', 'telefono', 'cantidad', 'zona', 'total','user_id',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
{
    return $this->belongsTo(User::class);
}

}
