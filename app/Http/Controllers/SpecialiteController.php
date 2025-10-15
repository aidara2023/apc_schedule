<?php

namespace App\Http\Controllers;

use App\Models\Specialite;
use Illuminate\Http\Request;

class SpecialiteController extends Controller
{
    // Afficher toutes les spécialités
    public function index()
    {
        return response()->json(Specialite::all(), 200);
    }

    // Créer une nouvelle spécialité
    public function store(Request $request)
    {
        $request->validate([
            'intitule' => 'required|unique:specialites'
        ]);

        $specialite = Specialite::create([
            'intitule' => $request->intitule
        ]);

        return response()->json($specialite, 201);
    }

    // Afficher une spécialité spécifique
    public function show($id)
    {
        $specialite = Specialite::findOrFail($id);
        return response()->json($specialite);
    }

    // Mettre à jour une spécialité
    public function update(Request $request, $id)
    {
        $specialite = Specialite::findOrFail($id);

        $request->validate([
            'intitule' => 'required|unique:specialites,intitule,' . $specialite->id
        ]);

        $specialite->update($request->all());
        return response()->json($specialite);
    }

    // Supprimer une spécialité
    public function destroy($id)
    {
        Specialite::destroy($id);
        return response()->json(['message' => 'Spécialité supprimée avec succès']);
    }
}
