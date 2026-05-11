<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VetementImage extends Model
{
    protected $fillable = ['vetement_id', 'image_url', 'ordre'];

    public function vetement()
    {
        return $this->belongsTo(Vetement::class);
    }
}
