<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InstitutionController;
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


Route::prefix('v1')->group(function () {
    Route::post('/auth/login', [AuthController::class, 'login']);


    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/auth/me', [AuthController::class, 'me']);

        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class,'listAll']);
            Route::post('/', [UserController::class,'create']);
            Route::get('/{user}', [UserController::class,'find']);
            Route::patch('/{user}', [UserController::class,'update']);
            Route::delete('/{user}', [UserController::class,'destroy']);
        });

        Route::prefix('institutions')->group(function(){
            Route::post('/', [InstitutionController::class, 'create']);

        });
    });
});
