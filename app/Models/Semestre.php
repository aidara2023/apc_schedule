<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    use HasFactory;

    protected $fillable = ['intitule']; // adapte selon ta migration

    /**
     * 🔗 Un semestre peut avoir plusieurs compétences.
     */
    

    public function competences()
{
    return $this->belongsToMany(Competence::class, 'comp_semestres');
}

}
