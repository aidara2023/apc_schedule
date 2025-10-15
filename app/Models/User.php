<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    
     use HasFactory, Notifiable;
     // Méthodes nécessaires pour JWT
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Les attributs qui peuvent être assignés en masse.
     */
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'date_naissance',
        'lieu_naissance',
        'photo',
        'matricule',
        'genre',
        'password',
        'role_id',
    ];

    /**
     * Les attributs à cacher lors de la sérialisation.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les attributs à convertir en types natifs.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_naissance' => 'date',
    ];

    /**
     * 🔗 Relation : Un utilisateur appartient à un rôle.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * 🔗 Relation : Un utilisateur peut être un formateur (s’il est lié dans la table formateurs).
     */
    public function formateur()
    {
        return $this->hasOne(Formateur::class);
    }
}
