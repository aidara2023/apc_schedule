<?php

namespace App\Http\Controllers;

use App\Models\Surveillant;
use Illuminate\Http\Request;
use Exception;

class SurveillantController extends Controller
{
    // 🔹 Lister tous les surveillants
    public function index()
    {
        $surveillants = Surveillant::with('user')->get();

        return response()->json([
            'success' => true,
            'data' => $surveillants
        ], 200);
    }

    // 🔹 Ajouter un surveillant
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
            ]);

            $surveillant = Surveillant::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Surveillant ajouté avec succès',
                'data' => $surveillant->load('user')
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création du surveillant',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // 🔹 Afficher un surveillant spécifique
    public function show($id)
    {
        $surveillant = Surveillant::with('user')->find($id);

        if (!$surveillant) {
            return response()->json([
                'success' => false,
                'message' => 'Surveillant non trouvé'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $surveillant
        ], 200);
    }

    // 🔹 Mettre à jour un surveillant
    public function update(Request $request, $id)
    {
        $surveillant = Surveillant::find($id);

        if (!$surveillant) {
            return response()->json([
                'success' => false,
                'message' => 'Surveillant non trouvé'
            ], 404);
        }

        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
        ]);

        $surveillant->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Surveillant mis à jour avec succès',
            'data' => $surveillant->load('user')
        ], 200);
    }

    // 🔹 Supprimer un surveillant
    public function destroy($id)
    {
        $surveillant = Surveillant::find($id);

        if (!$surveillant) {
            return response()->json([
                'success' => false,
                'message' => 'Surveillant non trouvé'
            ], 404);
        }

        $surveillant->delete();

        return response()->json([
            'success' => true,
            'message' => 'Surveillant supprimé avec succès'
        ], 200);
    }
}
