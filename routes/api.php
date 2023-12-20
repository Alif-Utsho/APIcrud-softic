<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;

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

Route::group(['namespace' => 'Api'], function () {
    Route::get('/users', [UserController::class, 'users']);
    Route::post('/user/store', [UserController::class, 'userStore']);
    Route::put('/user/update/{id}', [UserController::class, 'userUpdate']);
    Route::delete('/user/delete/{id}', [UserController::class, 'userDelete']);
});