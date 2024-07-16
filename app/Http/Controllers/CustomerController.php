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

class CustomerController extends Controller
{
    public function index()
    {
        return view('customers.index');
    }

    public function data()
    {
        $customers = User::whereHas('roles', function ($query) {
            $query->where('name', 'Customers')->orWhere('name', 'customer');
        })->get();
        return DataTables::of($customers)
            ->addColumn('state', function($user) {
                return $user->state->name;
            })
            ->addColumn('city', function($user) {
                return $user->city->name;
            })
            ->addColumn('action', function($customer) {
                return '<a href="'.route('customers.edit', $customer->id).'" class="btn btn-sm btn-primary">Edit</a>
                    <button class="btn btn-sm btn-danger delete-customer" data-id="'.$customer->id.'">Delete</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $states = State::all();
        return view('customers.create',compact('states'));
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

        $roles = Role::where('name', 'customer')->first();
        if($roles == null) {
            $roles = Role::create(['name' => 'customer']);
        }
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
        $customer = User::findOrFail($id);
        $states = State::all();
        $customer->hobbies = implode(',',json_decode($customer->hobbies));
        return view('customers.edit', compact('customer','states'));
    }

    public function update(SupplierUpdateRequest $request, $id)
    {
        $customer = User::findOrFail($id);
        $customer->update($request->validated());

        if ($request->hasfile('files')) {
            UserFile::where('user_id', $customer->id)->delete();
            foreach ($request->file('files') as $file) {
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path() . '/files/', $name);
    
                UserFile::create([
                    'user_id' => $customer->id,
                    'file_name' => $name,
                ]);
            }
        }

        return response()->json($customer, 200);
    }

    public function destroy($id)
    {
        $customer = User::findOrFail($id);
        $customer->delete();

        return response()->json(null, 204);
    }
}
