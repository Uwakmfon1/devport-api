<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
   return response()->json([
       'message' => 'Welcome to the API',
   ]);  
});



Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);
Route::middleware('auth:sanctum')->post('/posts', [PostController::class, 'store']);
Route::middleware('auth:sanctum')->put('/posts/{id}', [PostController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/posts/{id}', [PostController::class, 'destroy']);

Route::apiResource('/categories', CategoryController::class);
Route::apiResource('/tags', TagController::class);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);                
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');    