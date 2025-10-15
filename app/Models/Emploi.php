<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Emploi extends Model
{
    use HasFactory;

    protected $fillable = [
        'heure_debut',
        'heure_fin',
        'date_debut',
        'date_fin',
        'annee_id',
    ];

    /**
     * 🔗 Relation : un emploi appartient à une année
     */
    public function annee()
    {
        return $this->belongsTo(Annee::class);
    }

    /**
     * 🔗 Relation : un emploi peut concerner plusieurs compétences (Many-to-Many)
     */
    public function competences()
    {
        return $this->belongsToMany(Competence::class, 'competence_emploi')
                    ;
    }
}


