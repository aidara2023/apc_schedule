<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metier extends Model
{
    use HasFactory;

    protected $table = 'metiers'; // nom de la table
    protected $fillable = ['intitule', 'duree', 'niveau_id', 'departement_id'];

    // Relation avec Niveau : un métier appartient à un niveau
    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }

    // Relation avec Departement : un métier appartient à un département
    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    // Relation avec Eleves : un métier peut avoir plusieurs élèves
    public function eleves()
    {
        return $this->hasMany(Eleve::class);
    }
}
