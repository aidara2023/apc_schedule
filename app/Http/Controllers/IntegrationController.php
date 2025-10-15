<?php

namespace App\Http\Controllers;

use App\Models\Integration;
use Illuminate\Http\Request;

class IntegrationController extends Controller
{
    // 🔹 Lister toutes les intégrations
    public function index()
    {
        $integrations = Integration::all();

        return response()->json([
            'success' => true,
            'data' => $integrations
        ], 200);
    }

    // 🔹 Ajouter une intégration
    public function store(Request $request)
    {
        $validated = $request->validate([
            'duree' => 'required|string|max:50',
        ]);

        $integration = Integration::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Intégration ajoutée avec succès',
            'data' => $integration
        ], 201);
    }

    // 🔹 Afficher une intégration spécifique
    public function show($id)
    {
        $integration = Integration::find($id);

        if (!$integration) {
            return response()->json([
                'success' => false,
                'message' => 'Intégration non trouvée'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $integration
        ], 200);
    }

    // 🔹 Mettre à jour une intégration
    public function update(Request $request, $id)
    {
        $integration = Integration::find($id);

        if (!$integration) {
            return response()->json([
                'success' => false,
                'message' => 'Intégration non trouvée'
            ], 404);
        }

        $validated = $request->validate([
            'duree' => 'sometimes|string|max:50',
        ]);

        $integration->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Intégration mise à jour avec succès',
            'data' => $integration
        ], 200);
    }

    // 🔹 Supprimer une intégration
    public function destroy($id)
    {
        $integration = Integration::find($id);

        if (!$integration) {
            return response()->json([
                'success' => false,
                'message' => 'Intégration non trouvée'
            ], 404);
        }

        $integration->delete();

        return response()->json([
            'success' => true,
            'message' => 'Intégration supprimée avec succès'
        ], 200);
    }
}
