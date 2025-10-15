<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElementCompetence extends Model
{
    use HasFactory;

    protected $fillable = [
        'intitule',
        'code',
        'quota_horaire',
        'competence_id',
        'integration_id',
    ];

    /**
     * 🔗 Un élément de compétence appartient à une compétence.
     */
    public function competence()
    {
        return $this->belongsTo(Competence::class);
    }

    /**
     * 🔗 Un élément de compétence appartient à une intégration.
     */
    public function integration()
    {
        return $this->belongsTo(Integration::class);
    }
}
