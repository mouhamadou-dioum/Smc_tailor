<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'motDePasse',
    ];

    protected $hidden = [
        'motDePasse',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [];
    }

    public function getAuthPassword(): string
    {
        return $this->motDePasse;
    }

    /**
     * Laravel 11+ utilise getAuthPasswordName() pour savoir quel champ vérifier.
     * Sans ceci, Auth::attempt() cherche le champ "password" qui n'existe pas.
     */
    public function getAuthPasswordName(): string
    {
        return 'motDePasse';
    }

    public function vetements()
    {
        return $this->hasMany(Vetement::class);
    }
}
