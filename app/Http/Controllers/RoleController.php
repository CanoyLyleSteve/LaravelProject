<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return response()->json(Role::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
        ]);

        $role = Role::create(['name' => $request->name]);

        return response()->json([
            'message' => 'Role created successfully.',
            'role' => $role,
        ]);
    }

    public function show($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['message' => 'Role not found.'], 404);
        }
        return response()->json($role);
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['message' => 'Role not found.'], 404);
        }

        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $id,
        ]);

        $role->update(['name' => $request->name]);

        return response()->json([
            'message' => 'Role updated successfully.',
            'role' => $role,
        ]);
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['message' => 'Role not found.'], 404);
        }

        $role->delete();

        return response()->json(['message' => 'Role deleted successfully.']);
    }
}
