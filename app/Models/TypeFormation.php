<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeFormation extends Model
{
    use HasFactory;

    protected $table = 'type_formation'; // nom de la table
    protected $fillable = ['intitule'];

    // Relation avec Niveaux : un type de formation peut avoir plusieurs niveaux
    public function niveaux()
    {
        return $this->hasMany(Niveau::class);
    }
}
