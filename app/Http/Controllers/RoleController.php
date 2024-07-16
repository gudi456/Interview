<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use DataTables;
use App\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('roles.index');
    }

    public function data()
    {
        $roles = Role::select(['id', 'name'])->where('name', '!=', 'admin');
        return DataTables::of($roles)
            ->addColumn('action', function($role) {
                return '<a href="'.route('roles.edit', $role->id).'" class="btn btn-sm btn-primary">Edit</a>
                    <button class="btn btn-sm btn-danger delete-role" data-id="'.$role->id.'">Delete</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(RoleRequest $request)
    {
        $role = Role::create($request->validated());

        return response()->json($role, 201);
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('roles.edit', compact('role'));
    }

    public function update(RoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->update($request->validated());

        return response()->json($role, 200);
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return response()->json(null, 204);
    }
}
