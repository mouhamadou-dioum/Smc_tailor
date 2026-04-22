<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vetement extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'prix',
        'imageUrl',
        'disponible',
        'dateAjout',
        'admin_id',
        'categorie_id',
    ];

    protected function casts(): array
    {
        return [
            'prix' => 'decimal:2',
            'disponible' => 'boolean',
            'dateAjout' => 'datetime',
        ];
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class);
    }
}
