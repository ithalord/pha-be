<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use Auth;

class AuthenticationController extends Controller
{
    
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(false, HttpResponse::HTTP_UNAUTHORIZED);
        }

        $roles = [];
        foreach ( JWTAuth::toUser($token)->roles as $role ) {
            array_push($roles, $role->slug);
        }

        $user = User::with('roles')->find(Auth::user()->id);

        return response()->json(compact('token', 'roles','user'));
    }

    public function index()
    {
        // Retrieve all the users in the database and return them
        $users = User::all();
        return $users;
    }
    
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'can_borrow' => $data['can_borrow'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
