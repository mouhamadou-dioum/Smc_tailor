<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'motDePasse',
        'dateInscription',
    ];

    protected $hidden = [
        'motDePasse',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->motDePasse;
    }

    protected function casts(): array
    {
        return [
            'dateInscription' => 'datetime',
        ];
    }

    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function mesures()
    {
        return $this->hasMany(Mesure::class);
    }
}
