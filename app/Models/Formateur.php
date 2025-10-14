<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formateur extends Model
{
    use HasFactory;

    protected $table = 'formateurs'; 
    protected $fillable = ['specialite_id', 'user_id'];

    // Relation avec Specialite : un formateur appartient à une spécialité
    public function specialite()
    {
        return $this->belongsTo(Specialite::class);
    }

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function competences()
    {
        return $this->hasMany(Competence::class);
    }
}
