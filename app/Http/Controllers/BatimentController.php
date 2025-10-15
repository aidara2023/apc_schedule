<?php

namespace App\Http\Controllers;

use App\Models\Batiment;
use Illuminate\Http\Request;

class BatimentController extends Controller
{
    // 🔹 Lister tous les bâtiments
    public function index()
    {
        $batiments = Batiment::with('salles')->get();

        return response()->json([
            'success' => true,
            'data' => $batiments
        ], 200);
    }

    // 🔹 Ajouter un bâtiment
    public function store(Request $request)
    {
        $validated = $request->validate([
            'intitule' => 'required|string|max:255|unique:batiments,intitule',
        ]);

        $batiment = Batiment::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Bâtiment ajouté avec succès',
            'data' => $batiment
        ], 201);
    }

    // 🔹 Afficher un bâtiment spécifique
    public function show($id)
    {
        $batiment = Batiment::with('salles')->find($id);

        if (!$batiment) {
            return response()->json([
                'success' => false,
                'message' => 'Bâtiment non trouvé'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $batiment
        ], 200);
    }

    // 🔹 Mettre à jour un bâtiment
    public function update(Request $request, $id)
    {
        $batiment = Batiment::find($id);

        if (!$batiment) {
            return response()->json([
                'success' => false,
                'message' => 'Bâtiment non trouvé'
            ], 404);
        }

        $validated = $request->validate([
            'intitule' => 'sometimes|string|max:255|unique:batiments,intitule,' . $id,
        ]);

        $batiment->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Bâtiment mis à jour avec succès',
            'data' => $batiment
        ], 200);
    }

    // 🔹 Supprimer un bâtiment
    public function destroy($id)
    {
        $batiment = Batiment::find($id);

        if (!$batiment) {
            return response()->json([
                'success' => false,
                'message' => 'Bâtiment non trouvé'
            ], 404);
        }

        $batiment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Bâtiment supprimé avec succès'
        ], 200);
    }
}
