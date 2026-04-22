<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
    ];

    protected function casts(): array
    {
        return [];
    }

    public function vetements()
    {
        return $this->hasMany(Vetement::class);
    }
}