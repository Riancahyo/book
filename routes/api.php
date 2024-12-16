<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController as ApiBookController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\LoginController; 

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/login",action: [LoginController::class,"Login"]);

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('/books', ApiBookController::class);
});