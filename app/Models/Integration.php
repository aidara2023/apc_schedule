<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Integration extends Model
{
    use HasFactory;

    protected $fillable = [
        'duree',
    ];

    /**
     * 🔗 Une intégration possède plusieurs éléments de compétence.
     */
    public function elementCompetences()
    {
        return $this->hasMany(ElementCompetence::class);
    }
}
