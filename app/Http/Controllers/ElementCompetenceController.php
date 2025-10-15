<?php

namespace App\Http\Controllers;

use App\Models\ElementCompetence;
use Illuminate\Http\Request;

class ElementCompetenceController extends Controller
{
    // 🔹 Lister tous les éléments de compétence avec relations
    public function index()
    {
        $elements = ElementCompetence::with(['competence', 'integration'])->get();

        return response()->json([
            'success' => true,
            'data' => $elements
        ], 200);
    }

    // 🔹 Ajouter un élément de compétence
    public function store(Request $request)
    {
        $validated = $request->validate([
            'intitule' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:element_competences,code',
            'quota_horaire' => 'required|string|max:50',
            'competence_id' => 'required|exists:competences,id',
            'integration_id' => 'required|exists:integrations,id',
        ]);

        $element = ElementCompetence::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Élément de compétence ajouté avec succès',
            'data' => $element->load(['competence', 'integration'])
        ], 201);
    }

    // 🔹 Afficher un élément de compétence spécifique
    public function show($id)
    {
        $element = ElementCompetence::with(['competence', 'integration'])->find($id);

        if (!$element) {
            return response()->json([
                'success' => false,
                'message' => 'Élément de compétence non trouvé'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $element
        ], 200);
    }

    // 🔹 Mettre à jour un élément de compétence
    public function update(Request $request, $id)
    {
        $element = ElementCompetence::find($id);

        if (!$element) {
            return response()->json([
                'success' => false,
                'message' => 'Élément de compétence non trouvé'
            ], 404);
        }

        $validated = $request->validate([
            'intitule' => 'sometimes|string|max:255',
            'code' => 'sometimes|string|max:50|unique:element_competences,code,' . $id,
            'quota_horaire' => 'sometimes|string|max:50',
            'competence_id' => 'sometimes|exists:competences,id',
            'integration_id' => 'sometimes|exists:integrations,id',
        ]);

        $element->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Élément de compétence mis à jour avec succès',
            'data' => $element->load(['competence', 'integration'])
        ], 200);
    }

    // 🔹 Supprimer un élément de compétence
    public function destroy($id)
    {
        $element = ElementCompetence::find($id);

        if (!$element) {
            return response()->json([
                'success' => false,
                'message' => 'Élément de compétence non trouvé'
            ], 404);
        }

        $element->delete();

        return response()->json([
            'success' => true,
            'message' => 'Élément de compétence supprimé avec succès'
        ], 200);
    }
}
