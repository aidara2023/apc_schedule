<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompSemestre extends Model
{
    use HasFactory;

    // Nom explicite de la table (car ce n’est pas le pluriel Laravel par défaut)
    protected $table = 'comp_semestres';

    // Colonnes autorisées à être remplies
    protected $fillable = [
        'semestre_id',
        'competence_id',
    ];

    /**
     * Une entrée appartient à un semestre.
     */
    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    /**
     * Une entrée appartient à une compétence.
     */
    public function competence()
    {
        return $this->belongsTo(Competence::class);
    }
}
