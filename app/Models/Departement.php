<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $table = 'departements'; // nom de la table
    protected $fillable = ['nom_departement', 'user_id', 'batiment_id', 'formateur_id'];

    // Relation avec User : un département est lié à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec Batiment : un département appartient à un bâtiment
    public function batiment()
    {
        return $this->belongsTo(Batiment::class);
    }

    // Relation avec Formateur : un département est associé à un formateur
    public function formateur()
    {
        return $this->belongsTo(Formateur::class);
    }

    // Relation avec Metiers : un département peut avoir plusieurs métiers
    public function metiers()
    {
        return $this->hasMany(Metier::class);
    }
}
