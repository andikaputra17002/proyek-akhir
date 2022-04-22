<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\DokterController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('user', [UserController::class, 'dataProfil']);
    Route::post('user', [UserController::class, 'updateProfile']);
    Route::post('user/photo', [UserController::class, 'uploadPhoto']);
    Route::post('logout', [UserController::class, 'logout']);
    // Route::get('search/{name}', [DokterController::class, 'search']);

});
Route::get('dokter', [UserController::class, 'dataDokter']);
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);