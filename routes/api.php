<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\UserController;
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

        Route::prefix('institutions')->group(function () {
            Route::post('/', [InstitutionController::class, 'create']);
        });

        Route::prefix('library')->group(function () {
            Route::patch('/{library}', [LibraryController::class, 'update']);
        });

        Route::prefix('books')->group(function () {
            Route::get('/', [BookController::class,'listAll']);
            Route::post('/', [BookController::class,'create']);
            Route::get('/{book}', [BookController::class,'find']);
            Route::patch('/{book}', [BookController::class,'update']);
            Route::patch('/{book}/avatar', [BookController::class,'sendAvatar']);
            Route::delete('/{book}', [BookController::class,'destroy']);
        });

        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class,'listAll']);
            Route::post('/', [CategoryController::class,'create']);
            Route::get('/{category}', [CategoryController::class,'find']);
            Route::patch('/{category}', [CategoryController::class,'update']);
            Route::delete('/{category}', [CategoryController::class,'destroy']);
        });

        Route::prefix('rents')->group(function () {
            Route::get('/', [RentController::class,'listAll']);
            Route::post('/', [RentController::class,'rent']);
            Route::post('/{rent}/return', [RentController::class,'return']);
            Route::patch('/{rent}/prolong', [RentController::class,'prolong']);
        });

        Route::prefix('tags')->group(function () {
            Route::get('/', [TagController::class,'listAll']);
            Route::post('/', [TagController::class,'create']);
            Route::get('/{tag}', [TagController::class,'find']);
            Route::patch('/{tag}', [TagController::class,'update']);
            Route::delete('/{tag}', [TagController::class,'destroy']);
        });
    });
});
