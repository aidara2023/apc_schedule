<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompEmploi extends Model
{
    use HasFactory;

    // Nom exact de la table (car ce n’est pas le pluriel Laravel par défaut)
    protected $table = 'comp_emploi';

    // Colonnes qu’on peut remplir par assignation de masse
    protected $fillable = [
        'competence_id',
        'emploi_id',
    ];

    /**
     * Relation : une entrée appartient à une compétence.
     */
    public function competence()
    {
        return $this->belongsTo(Competence::class);
    }

    /**
     * Relation : une entrée appartient à un emploi.
     */
    public function emploi()
    {
        return $this->belongsTo(Emploi::class);
    }
}
