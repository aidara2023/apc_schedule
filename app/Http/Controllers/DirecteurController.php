<?php

namespace App\Http\Controllers;

use App\Models\Directeur;
use Illuminate\Http\Request;
use Exception;

class DirecteurController extends Controller
{
    // 🔹 Lister tous les directeurs
    public function index()
    {
        $directeurs = Directeur::with('user')->get();

        return response()->json([
            'success' => true,
            'data' => $directeurs
        ], 200);
    }

    // 🔹 Ajouter un directeur
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
            ]);

            $directeur = Directeur::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Directeur ajouté avec succès',
                'data' => $directeur->load('user')
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création du directeur',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // 🔹 Afficher un directeur spécifique
    public function show($id)
    {
        $directeur = Directeur::with('user')->find($id);

        if (!$directeur) {
            return response()->json([
                'success' => false,
                'message' => 'Directeur non trouvé'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $directeur
        ], 200);
    }

    // 🔹 Mettre à jour un directeur
    public function update(Request $request, $id)
    {
        $directeur = Directeur::find($id);

        if (!$directeur) {
            return response()->json([
                'success' => false,
                'message' => 'Directeur non trouvé'
            ], 404);
        }

        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
        ]);

        $directeur->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Directeur mis à jour avec succès',
            'data' => $directeur->load('user')
        ], 200);
    }

    // 🔹 Supprimer un directeur
    public function destroy($id)
    {
        $directeur = Directeur::find($id);

        if (!$directeur) {
            return response()->json([
                'success' => false,
                'message' => 'Directeur non trouvé'
            ], 404);
        }

        $directeur->delete();

        return response()->json([
            'success' => true,
            'message' => 'Directeur supprimé avec succès'
        ], 200);
    }
}
