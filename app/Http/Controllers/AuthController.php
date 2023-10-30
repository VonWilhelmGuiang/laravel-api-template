<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
        *Login 
        *@OA\POST(
        *   path="/api/auth/login",
        *   tags={"Auth"},
        *   summary="Authenticate user and generate JWT token",
        *   @OA\Parameter(
        *       name="email",
        *       in="query",
        *       description="User Email Address",
        *       required=true,
        *   ),
        *   @OA\Response(response="200", description="Login successful", @OA\JsonContent()),
        *   @OA\Response(response="401", description="Invalid credentials")
        *)
    */
    public function login(Request $request)
    {
        print_r($request->all());
        return response()->json(['description' => 'Login successful'], 200);
    }
}
