<?php

namespace App\Http\Controllers;

use App\Models\Metier;
use Illuminate\Http\Request;

class MetierController extends Controller
{
    // 🔹 Lister tous les métiers avec leurs niveaux et départements
    public function index()
    {
        $metiers = Metier::with(['niveau', 'departement'])->get();

        return response()->json([
            'success' => true,
            'data' => $metiers
        ], 200);
    }

    // 🔹 Ajouter un métier
    public function store(Request $request)
    {
        $validated = $request->validate([
            'intitule' => 'required|string|max:255',
            'duree' => 'required|string|max:50',
            'niveau_id' => 'required|exists:niveaux,id',
            'departement_id' => 'required|exists:departements,id',
        ]);

        $metier = Metier::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Métier ajouté avec succès',
            'data' => $metier->load(['niveau', 'departement'])
        ], 201);
    }

    // 🔹 Afficher un métier spécifique
    public function show($id)
    {
        $metier = Metier::with(['niveau', 'departement'])->find($id);

        if (!$metier) {
            return response()->json([
                'success' => false,
                'message' => 'Métier non trouvé'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $metier
        ], 200);
    }

    // 🔹 Mettre à jour un métier
    public function update(Request $request, $id)
    {
        $metier = Metier::find($id);

        if (!$metier) {
            return response()->json([
                'success' => false,
                'message' => 'Métier non trouvé'
            ], 404);
        }

        $validated = $request->validate([
            'intitule' => 'sometimes|string|max:255',
            'duree' => 'sometimes|string|max:50',
            'niveau_id' => 'sometimes|exists:niveaux,id',
            'departement_id' => 'sometimes|exists:departements,id',
        ]);

        $metier->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Métier mis à jour avec succès',
            'data' => $metier->load(['niveau', 'departement'])
        ], 200);
    }

    // 🔹 Supprimer un métier
    public function destroy($id)
    {
        $metier = Metier::find($id);

        if (!$metier) {
            return response()->json([
                'success' => false,
                'message' => 'Métier non trouvé'
            ], 404);
        }

        $metier->delete();

        return response()->json([
            'success' => true,
            'message' => 'Métier supprimé avec succès'
        ], 200);
    }
}
