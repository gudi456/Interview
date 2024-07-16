<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use DataTables;
use App\Role;
use App\User;
use App\State;
use App\City;
use App\Http\Requests\SupplierRequest;
use App\Http\Requests\SupplierUpdateRequest;
use Hash;
use App\UserFile;
use App\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        return view('suppliers.index');
    }

    public function data()
    {
        $suppliers = User::whereHas('roles', function ($query) {
            $query->where('name', 'Suppliers')->orWhere('name', 'supplier');
        })->get();
        return DataTables::of($suppliers)
            ->addColumn('state', function($user) {
                return $user->state->name;
            })
            ->addColumn('city', function($user) {
                return $user->city->name;
            })
            ->addColumn('action', function($supplier) {
                return '<a href="'.route('suppliers.edit', $supplier->id).'" class="btn btn-sm btn-primary">Edit</a>
                    <button class="btn btn-sm btn-danger delete-supplier" data-id="'.$supplier->id.'">Delete</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $states = State::all();
        return view('suppliers.create',compact('states'));
    }

    public function store(SupplierRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'email' => $validated['email'],
            'contact_number' => $validated['contact_number'],
            'postcode' => $validated['postcode'],
            'state_id' => $validated['state'],
            'city_id' => $validated['city'],
            'password' => Hash::make($validated['password']),
            'gender' => $validated['gender'],
            'hobbies' => json_encode($validated['hobbies']),
        ]);

        $roles = Role::where('name', 'supplier')->first();

        $user->roles()->attach($roles->id);

        if ($request->hasfile('files')) {
            foreach ($request->file('files') as $file) {
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path() . '/files/', $name);
    
                UserFile::create([
                    'user_id' => $user->id,
                    'file_name' => $name,
                ]);
            }
        }

        return response()->json($user, 201);
    }

    public function edit($id)
    {
        $supplier = User::findOrFail($id);
        $states = State::all();
        $supplier->hobbies = implode(',',json_decode($supplier->hobbies));
        return view('suppliers.edit', compact('supplier','states'));
    }

    public function update(SupplierUpdateRequest $request, $id)
    {
        $supplier = User::findOrFail($id);
        $supplier->update($request->validated());

        if ($request->hasfile('files')) {
            UserFile::where('user_id', $supplier->id)->delete();
            foreach ($request->file('files') as $file) {
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path() . '/files/', $name);
    
                UserFile::create([
                    'user_id' => $supplier->id,
                    'file_name' => $name,
                ]);
            }
        }

        return response()->json($supplier, 200);
    }

    public function destroy($id)
    {
        $supplier = User::findOrFail($id);
        $supplier->delete();

        return response()->json(null, 204);
    }
}
