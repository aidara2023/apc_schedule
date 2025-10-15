<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être remplis en masse.
     */
    protected $fillable = [
        'intitule',
        'numero_competence',
        'code',
        'formateur_id',
        'metier_id',
        'salle_id',
    ];

    /**
     * 🔗 Relation : une compétence appartient à un formateur.
     */
    public function formateur()
    {
        return $this->belongsTo(Formateur::class);
    }

    public function semestres()
{
    return $this->belongsToMany(Semestre::class, 'comp_semestres');
}

    /**
     * 🔗 Relation : une compétence appartient à un métier.
     */
    public function metier()
    {
        return $this->belongsTo(Metier::class);
    }

    /**
     * 🔗 Relation : une compétence se déroule dans une salle.
     */
    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }
    public function emplois()
{
    return $this->belongsToMany(Emploi::class, 'competence_emploi')
               ;
}


    
}
