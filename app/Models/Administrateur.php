<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrateur extends Model
{
    use HasFactory;

    protected $table = 'administrateurs'; // correspond au nom de la table
    protected $fillable = ['user_id']; // colonne que tu peux remplir

    // Relation avec User : un administrateur est lié à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
