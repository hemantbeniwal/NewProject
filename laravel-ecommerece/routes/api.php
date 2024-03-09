<?php

use App\Http\Controllers\API\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function(){
    Route::resource('users', UserController::class);
});

Route::get('get-token', function(){
    $user = User::find(11);
    $token = $user->createToken('auth:sanctum');

    return $token->plainTextToken;
    // die();
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
