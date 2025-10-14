<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batiment extends Model
{
    use HasFactory;

    protected $table = 'batiments'; // nom de la table
    protected $fillable = ['intitule'];

    // Relation avec Departements : un bâtiment peut avoir plusieurs départements
    public function departements()
    {
        return $this->hasMany(Departement::class);
    }
}
