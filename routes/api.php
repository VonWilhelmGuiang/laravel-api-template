<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\Permissions;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// auth
Route::controller(AuthController::class)->group(function () {
    Route::post('auth/login', 'login');
    Route::post('auth/register', 'register');
    Route::post('auth/logout', 'logout')->middleware(Permissions::class);
    Route::post('auth/refresh', 'refresh')->middleware(Permissions::class);
});

Route::controller(UserController::class)->group(function () {
    Route::get('users/employee/all','get_user')->middleware(Permissions::class);
    Route::get('user/id/{user_id}','get_user')->middleware(Permissions::class);
});