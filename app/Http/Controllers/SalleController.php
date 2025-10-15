<?php

namespace App\Http\Controllers;

use App\Models\Salle;
use Illuminate\Http\Request;

class SalleController extends Controller
{
    // 🔹 Lister toutes les salles
    public function index()
    {
        $salles = Salle::with('batiment')->get();

        return response()->json([
            'success' => true,
            'data' => $salles
        ], 200);
    }

    // 🔹 Ajouter une salle
    public function store(Request $request)
    {
        $validated = $request->validate([
            'intitule' => 'required|string|max:255',
            'capacite' => 'required|integer',
            'batiment_id' => 'required|exists:batiments,id',
        ]);

        $salle = Salle::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Salle ajoutée avec succès',
            'data' => $salle->load('batiment')
        ], 201);
    }

    // 🔹 Afficher une salle spécifique
    public function show($id)
    {
        $salle = Salle::with('batiment')->find($id);

        if (!$salle) {
            return response()->json([
                'success' => false,
                'message' => 'Salle non trouvée'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $salle
        ], 200);
    }

    // 🔹 Mettre à jour une salle
    public function update(Request $request, $id)
    {
        $salle = Salle::find($id);

        if (!$salle) {
            return response()->json([
                'success' => false,
                'message' => 'Salle non trouvée'
            ], 404);
        }

        $validated = $request->validate([
            'intitule' => 'sometimes|string|max:255',
            'capacite' => 'sometimes|integer',
            'batiment_id' => 'sometimes|exists:batiments,id',
        ]);

        $salle->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Salle mise à jour avec succès',
            'data' => $salle->load('batiment')
        ], 200);
    }

    // 🔹 Supprimer une salle
    public function destroy($id)
    {
        $salle = Salle::find($id);

        if (!$salle) {
            return response()->json([
                'success' => false,
                'message' => 'Salle non trouvée'
            ], 404);
        }

        $salle->delete();

        return response()->json([
            'success' => true,
            'message' => 'Salle supprimée avec succès'
        ], 200);
    }
}
