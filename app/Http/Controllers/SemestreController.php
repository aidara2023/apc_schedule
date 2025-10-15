<?php

namespace App\Http\Controllers;

use App\Models\Semestre;
use Illuminate\Http\Request;

class SemestreController extends Controller
{
    // 🔹 Lister tous les semestres
    public function index()
    {
        $semestres = Semestre::all();

        return response()->json([
            'success' => true,
            'data' => $semestres
        ], 200);
    }

    // 🔹 Ajouter un semestre
    public function store(Request $request)
    {
        $validated = $request->validate([
            'intitule' => 'required|string|max:255|unique:semestres,intitule',
        ]);

        $semestre = Semestre::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Semestre ajouté avec succès',
            'data' => $semestre
        ], 201);
    }

    // 🔹 Afficher un semestre spécifique
    public function show($id)
    {
        $semestre = Semestre::find($id);

        if (!$semestre) {
            return response()->json([
                'success' => false,
                'message' => 'Semestre non trouvé'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $semestre
        ], 200);
    }

    // 🔹 Mettre à jour un semestre
    public function update(Request $request, $id)
    {
        $semestre = Semestre::find($id);

        if (!$semestre) {
            return response()->json([
                'success' => false,
                'message' => 'Semestre non trouvé'
            ], 404);
        }

        $validated = $request->validate([
            'intitule' => 'sometimes|string|max:255|unique:semestres,intitule,' . $id,
        ]);

        $semestre->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Semestre mis à jour avec succès',
            'data' => $semestre
        ], 200);
    }

    // 🔹 Supprimer un semestre
    public function destroy($id)
    {
        $semestre = Semestre::find($id);

        if (!$semestre) {
            return response()->json([
                'success' => false,
                'message' => 'Semestre non trouvé'
            ], 404);
        }

        $semestre->delete();

        return response()->json([
            'success' => true,
            'message' => 'Semestre supprimé avec succès'
        ], 200);
    }
}
