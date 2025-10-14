<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    use HasFactory;

    protected $table = 'niveaux'; // nom de la table
    protected $fillable = ['intitule', 'type_formations_id'];

    // Relation avec TypeFormation : un niveau peut appartenir à un type de formation
    public function typeFormation()
    {
        return $this->belongsTo(TypeFormation::class, 'type_formations_id');
    }

    // Relation avec Metiers : un niveau peut avoir plusieurs métiers
    public function metiers()
    {
        return $this->hasMany(Metier::class);
    }
}
