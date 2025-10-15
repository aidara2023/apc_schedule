<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    // 🔹 Lister tous les départements avec leurs relations
    public function index()
    {
        $departements = Departement::with(['batiment', 'formateur', 'user'])->get();

        return response()->json([
            'success' => true,
            'data' => $departements
        ], 200);
    }

    // 🔹 Ajouter un département
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_departement' => 'required|string|max:255|unique:departements,nom_departement',
            'batiment_id' => 'required|exists:batiments,id',
            'formateur_id' => 'required|exists:formateurs,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $departement = Departement::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Département ajouté avec succès',
            'data' => $departement->load(['batiment', 'formateur', 'user'])
        ], 201);
    }

    // 🔹 Afficher un département spécifique
    public function show($id)
    {
        $departement = Departement::with(['batiment', 'formateur', 'user'])->find($id);

        if (!$departement) {
            return response()->json([
                'success' => false,
                'message' => 'Département non trouvé'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $departement
        ], 200);
    }

    // 🔹 Mettre à jour un département
    public function update(Request $request, $id)
    {
        $departement = Departement::find($id);

        if (!$departement) {
            return response()->json([
                'success' => false,
                'message' => 'Département non trouvé'
            ], 404);
        }

        $validated = $request->validate([
            'nom_departement' => 'sometimes|string|max:255|unique:departements,nom_departement,' . $id,
            'batiment_id' => 'sometimes|exists:batiments,id',
            'formateur_id' => 'sometimes|exists:formateurs,id',
            'user_id' => 'sometimes|exists:users,id',
        ]);

        $departement->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Département mis à jour avec succès',
            'data' => $departement->load(['batiment', 'formateur', 'user'])
        ], 200);
    }

    // 🔹 Supprimer un département
    public function destroy($id)
    {
        $departement = Departement::find($id);

        if (!$departement) {
            return response()->json([
                'success' => false,
                'message' => 'Département non trouvé'
            ], 404);
        }

        $departement->delete();

        return response()->json([
            'success' => true,
            'message' => 'Département supprimé avec succès'
        ], 200);
    }
}
