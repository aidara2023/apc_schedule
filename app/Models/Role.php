<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * Les attributs modifiables en masse.
     */
    protected $fillable = [
        'intitule',
    ];

    /**
     * 🔗 Relation : un rôle peut être associé à plusieurs utilisateurs.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
