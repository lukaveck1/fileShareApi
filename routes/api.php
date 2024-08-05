<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () { 
    Route::get('files', [\App\Http\Controllers\Api\FilesController::class, 'index']);
    Route::get('files/{file}', [\App\Http\Controllers\Api\FilesController::class, 'show']);
    Route::post('files', [\App\Http\Controllers\Api\FilesController::class, 'store']);
});