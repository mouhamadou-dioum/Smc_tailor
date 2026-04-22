<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    const TYPE_EMAIL = 'EMAIL';
    const TYPE_WHATSAPP = 'WHATSAPP';

    protected $fillable = [
        'type',
        'contenu',
        'dateEnvoi',
        'statut',
        'client_id',
        'rendez_vous_id',
    ];

    protected function casts(): array
    {
        return [
            'dateEnvoi' => 'datetime',
        ];
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function rendezVous()
    {
        return $this->belongsTo(RendezVous::class);
    }
}