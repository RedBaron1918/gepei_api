<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;


Route::apiResource('categories', CategoryController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/meals', [MealController::class, 'index']);
Route::get('/meals/search', [MealController::class, 'search']);
Route::get('/meals/{meal}', [MealController::class, 'show']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/meals', [MealController::class, 'userMeals']);
    Route::put('/meals/{meal}', [MealController::class, 'update']);
    Route::post('/meals', [MealController::class, 'store']);
    Route::delete('/meals/{meal}', [MealController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});
