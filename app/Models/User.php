<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Mail\CustomResetPasswordMail; // Importa tu Mailable personalizado
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_name',
        'phone',
        'address',
        'city',
        'country',
        'avatar',
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Sobrescribe el envío del correo de recuperación
     */
    public function sendPasswordResetNotification($token)
    {
        $url = url(route('password.reset', [
            'token' => $token,
            'email' => $this->email,
        ], false));

        Mail::to($this->email)->send(new CustomResetPasswordMail($url, $this));
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function favoritos()
{
    return $this->hasMany(Favorito::class);
}
public function eventosFavoritos()
{
    return $this->hasManyThrough(
        Event::class,
        Favorito::class,
        'user_id',      // Foreign key on Favorito table
        'id',           // Local key on Evento table
        'id',           // Local key on User table
        'evento_id'     // Foreign key on Favorito table
    );
}

public function preferences()
{
    return $this->hasMany(UserPreference::class);
}




}
