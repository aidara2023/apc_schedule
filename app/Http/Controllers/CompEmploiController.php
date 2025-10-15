<?php

namespace App\Http\Controllers;

use App\Models\CompEmploi;
use Illuminate\Http\Request;

class CompEmploiController extends Controller
{
    // 🔹 Lister tous les comp_emploi
    public function index()
    {
        $compEmplois = CompEmploi::with(['competence', 'emploi'])->get();

        return response()->json([
            'success' => true,
            'data' => $compEmplois
        ]);
    }

    // 🔹 Ajouter un comp_emploi
    public function store(Request $request)
    {
        $validated = $request->validate([
            'competence_id' => 'required|exists:competences,id',
            'emploi_id' => 'required|exists:emplois,id',
        ]);

        $compEmploi = CompEmploi::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Association compétence-emploi ajoutée avec succès',
            'data' => $compEmploi
        ], 201);
    }

    // 🔹 Afficher un comp_emploi spécifique
    public function show($id)
    {
        $compEmploi = CompEmploi::with(['competence', 'emploi'])->find($id);

        if (!$compEmploi) {
            return response()->json([
                'success' => false,
                'message' => 'Association non trouvée'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $compEmploi
        ]);
    }

    // 🔹 Supprimer un comp_emploi
    public function destroy($id)
    {
        $compEmploi = CompEmploi::find($id);

        if (!$compEmploi) {
            return response()->json([
                'success' => false,
                'message' => 'Association non trouvée'
            ], 404);
        }

        $compEmploi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Association supprimée avec succès'
        ]);
    }
}
