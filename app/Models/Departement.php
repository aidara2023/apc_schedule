<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_departement',
        'batiment_id',
        'formateur_id', // chef du département
    ];

    // Relation avec Batiment
    public function batiment()
    {
        return $this->belongsTo(Batiment::class);
    }

    // Relation avec Formateur (chef)
    public function chef()
    {
        return $this->belongsTo(Formateur::class, 'formateur_id');
    }

    // Relation avec Metiers
    public function metiers()
    {
        return $this->hasMany(Metier::class);
    }
}
