<?php

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\UserController;

Route::post('login', [UserController::class, 'login']);
Route::post('register',[UserController::class,'register']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('books', GameController::class);
    Route::apiResource('reader', UserController::class);
    Route::post('books/{game}/reader/{reader}', [GameController::class, 'assignCommittee']);
});


