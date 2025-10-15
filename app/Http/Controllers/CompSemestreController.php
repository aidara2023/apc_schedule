<?php

namespace App\Http\Controllers;

use App\Models\CompSemestre;
use Illuminate\Http\Request;

class CompSemestreController extends Controller
{
    // 🔹 Lister tous les comp_semestres
    public function index()
    {
        $compSemestres = CompSemestre::with(['competence', 'semestre'])->get();

        return response()->json([
            'success' => true,
            'data' => $compSemestres
        ]);
    }

    // 🔹 Ajouter un comp_semestre
    public function store(Request $request)
    {
        $validated = $request->validate([
            'competence_id' => 'required|exists:competences,id',
            'semestre_id' => 'required|exists:semestres,id',
        ]);

        $compSemestre = CompSemestre::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Association compétence-semestre ajoutée avec succès',
            'data' => $compSemestre
        ], 201);
    }

    // 🔹 Afficher un comp_semestre spécifique
    public function show($id)
    {
        $compSemestre = CompSemestre::with(['competence', 'semestre'])->find($id);

        if (!$compSemestre) {
            return response()->json([
                'success' => false,
                'message' => 'Association non trouvée'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $compSemestre
        ]);
    }

    // 🔹 Supprimer un comp_semestre
    public function destroy($id)
    {
        $compSemestre = CompSemestre::find($id);

        if (!$compSemestre) {
            return response()->json([
                'success' => false,
                'message' => 'Association non trouvée'
            ], 404);
        }

        $compSemestre->delete();

        return response()->json([
            'success' => true,
            'message' => 'Association supprimée avec succès'
        ]);
    }
}
