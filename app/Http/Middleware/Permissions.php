<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Permissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $admin_endpoints = [
            'App\Http\Controllers\AuthController@refresh',
            'App\Http\Controllers\UserController@dashboard_data',
            'App\Http\Controllers\UserController@get_user',
        ];

        $employee_endpoints = [
            'App\Http\Controllers\AuthController@refresh',
            'App\Http\Controllers\UserController@dashboard_data'
        ];
       

        // check permissions of token
        if(Auth::check()){
            if(Auth::user()->user_type === "employee"){
                if( in_array($request->route()->getActionName(),$employee_endpoints)  ) {
                    return $next($request);
                }else{
                    return response()->json(['status' => 'Unauthorized'], 401);
                }
            }else if(Auth::user()->user_type === "admin"){
                if( in_array($request->route()->getActionName(),$admin_endpoints)  ) {
                    return $next($request);
                }else{
                    return response()->json(['status' => 'Unauthorized'], 401);
                }
            }
        }else{
            return response()->json(['status' => 'Unauthorized'], 401);
        }
    }
    
}
