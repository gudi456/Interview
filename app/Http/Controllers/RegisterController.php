<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\City;
use App\Role;
use App\User;
use App\Permission;
use App\UserFile;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\LoginRequest;
use App\UserLogin;
use Auth;

class RegisterController extends Controller
{
    public function index()
    {
        $states = State::all();
        $roles = Role::whereNotIn('name', ['admin'])->get();
        return view('register', compact('states', 'roles'));
    }

    public function getCitiesByState($state_id)
    {
        $cities = City::where('state_id', $state_id)->get();
        return response()->json($cities);
    }

    public function register(RegisterUserRequest $request)
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
    
    $user->roles()->attach($validated['roles']);

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

    Session::put('user', $user); // Set user in session

    $token = $user->createToken('Laravel Password Grant Client')->accessToken;
    return response()->json(['message' => 'Register successfully!', 'user' => $user, 'token' => $token], 200);
}

    public function login()
    {
        return view('login');
    }

    public function postLogin(LoginRequest $request)
    {

        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();
        try {
            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                    Session::put('user', $user);
                    return response()->json(['message' => 'Login successfully!', 'token' => $token, 'user' => $user->roles[0]->name], 200);
                }
                return response()->json(['message' => 'Password does not match'], 400);
            }else{
                return response()->json([
                    'message' => 'User Does not exist',
                ]);

            }
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
