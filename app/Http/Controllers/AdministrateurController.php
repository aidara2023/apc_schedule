<?php

namespace App\Http\Controllers;

use App\Models\Administrateur;
use Illuminate\Http\Request;
use Exception;

class AdministrateurController extends Controller
{
    // 🔹 Lister tous les administrateurs
    public function index()
    {
        $administrateurs = Administrateur::with('user')->get();

        return response()->json([
            'success' => true,
            'data' => $administrateurs
        ], 200);
    }

    // 🔹 Ajouter un administrateur
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
            ]);

            $administrateur = Administrateur::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Administrateur ajouté avec succès',
                'data' => $administrateur->load('user')
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de l’administrateur',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // 🔹 Afficher un administrateur spécifique
    public function show($id)
    {
        $administrateur = Administrateur::with('user')->find($id);

        if (!$administrateur) {
            return response()->json([
                'success' => false,
                'message' => 'Administrateur non trouvé'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $administrateur
        ], 200);
    }

    // 🔹 Mettre à jour un administrateur
    public function update(Request $request, $id)
    {
        $administrateur = Administrateur::find($id);

        if (!$administrateur) {
            return response()->json([
                'success' => false,
                'message' => 'Administrateur non trouvé'
            ], 404);
        }

        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
        ]);

        $administrateur->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Administrateur mis à jour avec succès',
            'data' => $administrateur->load('user')
        ], 200);
    }

    // 🔹 Supprimer un administrateur
    public function destroy($id)
    {
        $administrateur = Administrateur::find($id);

        if (!$administrateur) {
            return response()->json([
                'success' => false,
                'message' => 'Administrateur non trouvé'
            ], 404);
        }

        $administrateur->delete();

        return response()->json([
            'success' => true,
            'message' => 'Administrateur supprimé avec succès'
        ], 200);
    }
}
