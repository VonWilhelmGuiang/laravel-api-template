<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required','string','email'],
            'password' => ['required','string'],
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Incorrect login credentials.',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'auth' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ],201);

    }

    public function register(Request $request){
        $user_type = $request->post('user_type') === 'admin' ? 'admin' : 'employee';
        $data = $request->validate([
            'first_name' => ['required','string'],
            'last_name' => ['required','string'],
            'email' => ['required','string','unique:users,email'],
            'password' => ['required', 'string','confirmed']
        ]);

        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name'=> $data['last_name'],
            'user_type' => $user_type,
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'auth' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
