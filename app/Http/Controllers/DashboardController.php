<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\User;
use DataTables;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Session::get('user');
        if ($user) {
            return view('dashboard');
        }
        return redirect('api/login');
    }

    public function data(Request $request)
    {
        $token = $request->header('Authorization');
        $token = str_replace('Bearer ', '', $token);
        $user_data = Auth::guard('api')->user();
        $users = User::whereNotIn('id', [$user_data->id, 1])->select(['id', 'firstname', 'lastname', 'email', 'contact_number', 'state_id', 'city_id']);
        return DataTables::of($users)
            ->addColumn('state', function($user) {
                return $user->state->name;
            })
            ->addColumn('city', function($user) {
                return $user->city->name;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        Session::flush();
        
        return redirect()->route('user.login');
    }


}
