<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;

    protected $table = 'salles';
    protected $fillable = ['intitule', 'capacite', 'batiment_id'];

    
    public function batiment()
    {
        return $this->belongsTo(Batiment::class);
    }
}
