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

    // Statuts de production
    const PROD_EN_ATTENTE = 'EN_ATTENTE';
    const PROD_MESURES    = 'MESURES';
    const PROD_COUPE      = 'COUPE';
    const PROD_COUTURE    = 'COUTURE';
    const PROD_FINITIONS  = 'FINITIONS';
    const PROD_PRET       = 'PRET';
    const PROD_LIVRE      = 'LIVRE';

    protected $fillable = [
        'dateRendezVous',
        'heure',
        'statut',
        'statut_production',
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
