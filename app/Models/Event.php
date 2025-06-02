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

    public function user()
    {
        return $this->belongsTo(User::class); // Un evento pertenece a un usuario
    }
// En app/Models/Evento.php
public function mensajes()
{
    return $this->hasMany(Message::class)->latest();
}

public function usuariosFavoritos()
{
    return $this->belongsToMany(User::class, 'evento_user', 'evento_id', 'user_id');
}

public function asientos()
{
    return $this->hasMany(Asiento::class, 'events_id');
}

}
