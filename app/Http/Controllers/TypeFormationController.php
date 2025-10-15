<?php

namespace App\Http\Controllers;

use App\Models\TypeFormation;
use Illuminate\Http\Request;

class TypeFormationController extends Controller
{
    // 🔹 Lister tous les types de formation
    public function index()
    {
        $types = TypeFormation::all();

        return response()->json([
            'success' => true,
            'data' => $types
        ], 200);
    }

    // 🔹 Ajouter un type de formation
    public function store(Request $request)
    {
        $validated = $request->validate([
            'intitule' => 'required|string|unique:type_formations,intitule|max:255',
        ]);

        $type = TypeFormation::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Type de formation ajouté avec succès',
            'data' => $type
        ], 201);
    }

    // 🔹 Afficher un type de formation spécifique
    public function show($id)
    {
        $type = TypeFormation::find($id);

        if (!$type) {
            return response()->json([
                'success' => false,
                'message' => 'Type de formation non trouvé'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $type
        ], 200);
    }

    // 🔹 Mettre à jour un type de formation
    public function update(Request $request, $id)
    {
        $type = TypeFormation::find($id);

        if (!$type) {
            return response()->json([
                'success' => false,
                'message' => 'Type de formation non trouvé'
            ], 404);
        }

        $validated = $request->validate([
            'intitule' => 'sometimes|string|unique:type_formations,intitule,' . $type->id,
        ]);

        $type->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Type de formation mis à jour avec succès',
            'data' => $type
        ], 200);
    }

    // 🔹 Supprimer un type de formation
    public function destroy($id)
    {
        $type = TypeFormation::find($id);

        if (!$type) {
            return response()->json([
                'success' => false,
                'message' => 'Type de formation non trouvé'
            ], 404);
        }

        $type->delete();

        return response()->json([
            'success' => true,
            'message' => 'Type de formation supprimé avec succès'
        ], 200);
    }
}
