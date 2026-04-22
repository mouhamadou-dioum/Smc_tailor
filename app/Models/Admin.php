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

    public function getAuthPassword()
    {
        return $this->motDePasse;
    }

    public function vetements()
    {
        return $this->hasMany(Vetement::class);
    }
}
