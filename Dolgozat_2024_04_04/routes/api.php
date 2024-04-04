<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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

// auth
Route::middleware('auth:sanctum')->group(function () {
    // data manipulation
    Route::get('/profile', [ProfileController::class, 'getUserProfileData']);
    Route::put('/profile', [ProfileController::class, 'setUserProfileData']);
    Route::put('/profile/password', [ProfileController::class, 'setNewPassword']);
    Route::delete('/profile', [ProfileController::class, 'deleteAccount']);
    //Route::post('/profile/update-city-id', [ProfileController::class, 'updateCityId']);

    // Logout endpoint
    Route::post("/logout", [AuthController::class, "logout"]);
});

// no auth
Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);

// citymaker
Route::post("/cities", [CityController::class, "store"]);

