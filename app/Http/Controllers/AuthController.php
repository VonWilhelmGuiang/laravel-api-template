<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Required @OA\Info(title="deda", version="0.1")
 * @OA\SecurityScheme(
 *     type="http",
 *     securityScheme="bearerAuth",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
*/
class AuthController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
        *@OA\Post(
        *   path="/api/login",
        *   tags={"Auth"},
        *   summary="Authenticate user and generate JWT token",
        *   @OA\Parameter(
        *       name="email",
        *       in="query",
        *       description="User's email",
        *       required=true,
        *       @OA\Schema(type="string")
        *   ),
        *   @OA\Parameter(
        *       name="password",
        *       in="query",
        *       description="User's password",
        *       required=true,
        *       @OA\Schema(type="string")
        *   ),
        *   @OA\Response(response="200", description="Login successful"),
        *   @OA\Response(response="401", description="Invalid credentials")
        *)
    */
    public function login()
    {
        
    }
}
