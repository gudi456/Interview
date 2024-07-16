<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;

class RolePermissionController extends Controller
{

    public function index()
    {
        $roles = Role::where('name', '!=', 'admin')->get();
        $permissions = Permission::all();
        return view('role_permissions.index', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        foreach ($request->roles as $roleId => $permissions) {
            $role = Role::find($roleId);
            if ($role) {
                $role->permissions()->sync($permissions);
            }
        }
        
        return response()->json(['message' => 'Roles and permissions updated successfully'], 200);
    }
}
