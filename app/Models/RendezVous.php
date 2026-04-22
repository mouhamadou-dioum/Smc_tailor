<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    use HasFactory;

    const STATUT_EN_ATTENTE = 'EN_ATTENTE';
    const STATUT_CONFIRME = 'CONFIRME';
    const STATUT_REFUSE = 'REFUSE';

    protected $fillable = [
        'dateRendezVous',
        'heure',
        'statut',
        'commentaire',
        'dateCreation',
        'client_id',
        'vetement_id',
    ];

    protected function casts(): array
    {
        return [
            'dateRendezVous' => 'datetime',
            'dateCreation' => 'datetime',
        ];
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function vetement()
    {
        return $this->belongsTo(Vetement::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
