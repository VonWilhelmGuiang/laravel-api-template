<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function get_user(Request $request){
        $users = $request->user_id ? 
            DB::table('users')->select('id','first_name','last_name','created_at as date_created')->find($request->user_id)
        : 
            DB::table('users')->select('id','first_name','last_name','created_at as date_created')->get();

        return response()->json(['users'=> $users],200);

    }
}
