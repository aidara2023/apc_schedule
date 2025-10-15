<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use Illuminate\Http\Request;
use Exception;

class EleveController extends Controller
{
    // 🔹 Lister tous les élèves avec leurs relations
    public function index()
    {
        $eleves = Eleve::with(['user', 'metier'])->get();

        return response()->json([
            'success' => true,
            'data' => $eleves
        ], 200);
    }

    // 🔹 Ajouter un élève
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'metier_id' => 'required|exists:metiers,id',
            ]);

            $eleve = Eleve::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Élève ajouté avec succès',
                'data' => $eleve->load(['user', 'metier'])
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de l’élève',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // 🔹 Afficher un élève spécifique
    public function show($id)
    {
        $eleve = Eleve::with(['user', 'metier'])->find($id);

        if (!$eleve) {
            return response()->json([
                'success' => false,
                'message' => 'Élève non trouvé'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $eleve
        ], 200);
    }

    // 🔹 Mettre à jour un élève
    public function update(Request $request, $id)
    {
        $eleve = Eleve::find($id);

        if (!$eleve) {
            return response()->json([
                'success' => false,
                'message' => 'Élève non trouvé'
            ], 404);
        }

        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'metier_id' => 'sometimes|exists:metiers,id',
        ]);

        $eleve->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Élève mis à jour avec succès',
            'data' => $eleve->load(['user', 'metier'])
        ], 200);
    }

    // 🔹 Supprimer un élève
    public function destroy($id)
    {
        $eleve = Eleve::find($id);

        if (!$eleve) {
            return response()->json([
                'success' => false,
                'message' => 'Élève non trouvé'
            ], 404);
        }

        $eleve->delete();

        return response()->json([
            'success' => true,
            'message' => 'Élève supprimé avec succès'
        ], 200);
    }
}
