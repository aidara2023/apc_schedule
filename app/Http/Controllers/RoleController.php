<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    // Liste des rôles
    public function index()
    {
        return response()->json(Role::all());
    }

    // Créer un rôle
    public function store(Request $request)
    {
        $request->validate([
            'intitule' => 'required|unique:roles,intitule'
        ]);

        $role = Role::create($request->all());

        return response()->json($role, 201);
    }

    // Afficher un rôle
    public function show($id)
    {
        return response()->json(Role::findOrFail($id));
    }

    // Mettre à jour un rôle
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->update($request->all());
        return response()->json($role);
    }

    // Supprimer un rôle
    public function destroy($id)
    {
        Role::destroy($id);
        return response()->json(null, 204);
    }
}
