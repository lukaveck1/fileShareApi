<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// If we want to show data on web app without auth
//Route::get('files', [\App\Http\Controllers\Api\FilesController::class, 'index']);
//Route::get('files/{file}', [\App\Http\Controllers\Api\FilesController::class, 'show']);