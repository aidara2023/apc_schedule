<?php

namespace App\Http\Controllers;

use App\Models\Annee;
use Illuminate\Http\Request;

class AnneeController extends Controller
{
    // 🔹 Lister toutes les années
    public function index()
    {
        $annees = Annee::all();

        return response()->json([
            'success' => true,
            'data' => $annees
        ], 200);
    }

    // 🔹 Ajouter une année
    public function store(Request $request)
    {
        $validated = $request->validate([
            'intitule' => 'required|string|unique:annees,intitule',
        ]);

        $annee = Annee::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Année ajoutée avec succès',
            'data' => $annee
        ], 201);
    }

    // 🔹 Afficher une année spécifique
    public function show($id)
    {
        $annee = Annee::find($id);

        if (!$annee) {
            return response()->json([
                'success' => false,
                'message' => 'Année non trouvée'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $annee
        ], 200);
    }

    // 🔹 Mettre à jour une année
    public function update(Request $request, $id)
    {
        $annee = Annee::find($id);

        if (!$annee) {
            return response()->json([
                'success' => false,
                'message' => 'Année non trouvée'
            ], 404);
        }

        $validated = $request->validate([
            'intitule' => 'sometimes|string|unique:annees,intitule,' . $id,
        ]);

        $annee->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Année mise à jour avec succès',
            'data' => $annee
        ], 200);
    }

    // 🔹 Supprimer une année
    public function destroy($id)
    {
        $annee = Annee::find($id);

        if (!$annee) {
            return response()->json([
                'success' => false,
                'message' => 'Année non trouvée'
            ], 404);
        }

        $annee->delete();

        return response()->json([
            'success' => true,
            'message' => 'Année supprimée avec succès'
        ], 200);
    }
}
