<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annee extends Model
{
    use HasFactory;

    /**
     * Les champs modifiables en masse
     */
    protected $fillable = [
        'intitule', // par exemple "2025-2026"
       
    ];

    /**
     * 🔗 Relation : une année peut avoir plusieurs emplois
     */
    public function emplois()
    {
        return $this->hasMany(Emploi::class);
    }
}
