<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesure extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'nom',
        'cou',
        'epaule',
        'manche',
        'hanche',
        'tourbras',
        'longueurChemise',
        'longueurBoubou',
        'longueurPantalon',
        'cuisse',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}