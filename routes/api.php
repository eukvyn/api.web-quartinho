<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\AuthenticatedTokenController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return 'welcome to API web quartinho';
});

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedTokenController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'profile']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/properties', [PropertyController::class, 'store']);
    Route::post('/properties/{id}', [PropertyController::class, 'update']);
    Route::delete('/properties/{id}', [PropertyController::class, 'destroy']);
    Route::post('/properties/{id}/comments', [CommentController::class, 'store']);
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']);
});

Route::get('/properties', [PropertyController::class, 'index']);
Route::get('/properties/{id}', [PropertyController::class, 'show']);
Route::get('/properties/{id}/comments', [CommentController::class, 'index']);
