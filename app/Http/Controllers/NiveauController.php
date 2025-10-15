<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use Illuminate\Http\Request;

class NiveauController extends Controller
{
    // 🔹 Lister tous les niveaux avec leurs types de formation
    public function index()
    {
        $niveaux = Niveau::with('typeFormation')->get();

        return response()->json([
            'success' => true,
            'data' => $niveaux
        ], 200);
    }

    // 🔹 Ajouter un niveau
    public function store(Request $request)
    {
        $validated = $request->validate([
            'intitule' => 'required|string|unique:niveaux,intitule|max:255',
            'type_formations_id' => 'nullable|exists:type_formations,id',
        ]);

        $niveau = Niveau::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Niveau ajouté avec succès',
            'data' => $niveau->load('typeFormation')
        ], 201);
    }

    // 🔹 Afficher un niveau spécifique
    public function show($id)
    {
        $niveau = Niveau::with('typeFormation')->find($id);

        if (!$niveau) {
            return response()->json([
                'success' => false,
                'message' => 'Niveau non trouvé'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $niveau
        ], 200);
    }

    // 🔹 Mettre à jour un niveau
    public function update(Request $request, $id)
    {
        $niveau = Niveau::find($id);

        if (!$niveau) {
            return response()->json([
                'success' => false,
                'message' => 'Niveau non trouvé'
            ], 404);
        }

        $validated = $request->validate([
            'intitule' => 'sometimes|string|unique:niveaux,intitule,' . $niveau->id,
            'type_formations_id' => 'nullable|exists:type_formations,id',
        ]);

        $niveau->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Niveau mis à jour avec succès',
            'data' => $niveau->load('typeFormation')
        ], 200);
    }

    // 🔹 Supprimer un niveau
    public function destroy($id)
    {
        $niveau = Niveau::find($id);

        if (!$niveau) {
            return response()->json([
                'success' => false,
                'message' => 'Niveau non trouvé'
            ], 404);
        }

        $niveau->delete();

        return response()->json([
            'success' => true,
            'message' => 'Niveau supprimé avec succès'
        ], 200);
    }
}
