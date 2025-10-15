<?php

namespace App\Http\Controllers;

use App\Models\Competence;
use Illuminate\Http\Request;

class CompetenceController extends Controller
{
    // 🔹 Lister toutes les compétences avec relations
    public function index()
    {
        $competences = Competence::with(['formateur', 'metier', 'salle'])->get();

        return response()->json([
            'success' => true,
            'data' => $competences
        ], 200);
    }

    // 🔹 Ajouter une compétence
    public function store(Request $request)
    {
        $validated = $request->validate([
            'intitule' => 'required|string|max:255',
            'numero_competence' => 'required|numeric|unique:competences,numero_competence',
            'code' => 'required|string|max:50|unique:competences,code',
            'formateur_id' => 'required|exists:formateurs,id',
            'metier_id' => 'required|exists:metiers,id',
            'salle_id' => 'required|exists:salles,id',
        ]);

        $competence = Competence::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Compétence ajoutée avec succès',
            'data' => $competence->load(['formateur', 'metier', 'salle'])
        ], 201);
    }

    // 🔹 Afficher une compétence spécifique
    public function show($id)
    {
        $competence = Competence::with(['formateur', 'metier', 'salle'])->find($id);

        if (!$competence) {
            return response()->json([
                'success' => false,
                'message' => 'Compétence non trouvée'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $competence
        ], 200);
    }

    // 🔹 Mettre à jour une compétence
    public function update(Request $request, $id)
    {
        $competence = Competence::find($id);

        if (!$competence) {
            return response()->json([
                'success' => false,
                'message' => 'Compétence non trouvée'
            ], 404);
        }

        $validated = $request->validate([
            'intitule' => 'sometimes|string|max:255',
            'numero_competence' => 'sometimes|numeric|unique:competences,numero_competence,' . $id,
            'code' => 'sometimes|string|max:50|unique:competences,code,' . $id,
            'formateur_id' => 'sometimes|exists:formateurs,id',
            'metier_id' => 'sometimes|exists:metiers,id',
            'salle_id' => 'sometimes|exists:salles,id',
        ]);

        $competence->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Compétence mise à jour avec succès',
            'data' => $competence->load(['formateur', 'metier', 'salle'])
        ], 200);
    }

    // 🔹 Supprimer une compétence
    public function destroy($id)
    {
        $competence = Competence::find($id);

        if (!$competence) {
            return response()->json([
                'success' => false,
                'message' => 'Compétence non trouvée'
            ], 404);
        }

        $competence->delete();

        return response()->json([
            'success' => true,
            'message' => 'Compétence supprimée avec succès'
        ], 200);
    }
}
