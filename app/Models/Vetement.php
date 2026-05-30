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

    public function images()
    {
        return $this->hasMany(VetementImage::class)->orderBy('ordre');
    }

    public function mainImage()
    {
        return $this->hasOne(VetementImage::class)->where('ordre', 0);
    }

    public function detailImages()
    {
        return $this->hasMany(VetementImage::class)->where('ordre', '>', 0)->orderBy('ordre');
    }

    public function getImageUrlAttribute($value)
    {
        if ($this->relationLoaded('mainImage') && $this->mainImage) {
            return $this->mainImage->image_url;
        }

        // CORRECTIF PERFORMANCE (N+1) : Si la relation 'images' est déjà chargée, on filtre en mémoire vive.
        // Sinon, on effectue une requête ciblée pour éviter de charger toutes les images.
        if ($this->relationLoaded('images')) {
            $main = $this->images->where('ordre', 0)->first();
        } else {
            $main = $this->images()->where('ordre', 0)->first();
        }
        
        return $main ? $main->image_url : $value;
    }
}
