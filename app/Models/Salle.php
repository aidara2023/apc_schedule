<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;

    protected $table = 'salles'; // nom de la table
    protected $fillable = ['intitule', 'capacite', 'batiment_id'];

    // Relation avec Batiment : une salle appartient à un bâtiment
    public function batiment()
    {
        return $this->belongsTo(Batiment::class);
    }
}
