<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ProjectApiController;
use App\Http\Controllers\Api\TaskApiController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/projects', [ProjectApiController::class, 'index']);
    Route::get('/projects/{project}', [ProjectApiController::class, 'show']);
    Route::get('/tasks', [TaskApiController::class, 'index']);
    Route::get('/tasks/{task}', [TaskApiController::class, 'show']);
    
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
