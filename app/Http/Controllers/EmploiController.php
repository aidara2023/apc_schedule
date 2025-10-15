<?php

namespace App\Http\Controllers;

use App\Models\Emploi;
use Illuminate\Http\Request;

class EmploiController extends Controller
{
    // 🔹 Lister tous les emplois
    public function index()
    {
        $emplois = Emploi::with('annee')->get();

        return response()->json([
            'success' => true,
            'data' => $emplois
        ], 200);
    }

    // 🔹 Ajouter un emploi
    public function store(Request $request)
    {
        $validated = $request->validate([
            'heure_debut' => 'required|string',
            'heure_fin' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'annee_id' => 'required|exists:annees,id',
        ]);

        $emploi = Emploi::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Emploi ajouté avec succès',
            'data' => $emploi->load('annee')
        ], 201);
    }

    // 🔹 Afficher un emploi spécifique
    public function show($id)
    {
        $emploi = Emploi::with('annee')->find($id);

        if (!$emploi) {
            return response()->json([
                'success' => false,
                'message' => 'Emploi non trouvé'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $emploi
        ], 200);
    }

    // 🔹 Mettre à jour un emploi
    public function update(Request $request, $id)
    {
        $emploi = Emploi::find($id);

        if (!$emploi) {
            return response()->json([
                'success' => false,
                'message' => 'Emploi non trouvé'
            ], 404);
        }

        $validated = $request->validate([
            'heure_debut' => 'sometimes|string',
            'heure_fin' => 'sometimes|string',
            'date_debut' => 'sometimes|date',
            'date_fin' => 'sometimes|date',
            'annee_id' => 'sometimes|exists:annees,id',
        ]);

        $emploi->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Emploi mis à jour avec succès',
            'data' => $emploi->load('annee')
        ], 200);
    }

    // 🔹 Supprimer un emploi
    public function destroy($id)
    {
        $emploi = Emploi::find($id);

        if (!$emploi) {
            return response()->json([
                'success' => false,
                'message' => 'Emploi non trouvé'
            ], 404);
        }

        $emploi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Emploi supprimé avec succès'
        ], 200);
    }
}
