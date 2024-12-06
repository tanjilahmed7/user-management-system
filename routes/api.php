<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;

// Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

// Role Routes
Route::middleware(['auth:api'])->group(function () {

    // Dashboard Route
    Route::get('/welcome', [UserController::class, 'welcome']);

    // Article Routes
    Route::prefix('articles')->middleware('permission:view-post')->group(function () {
        Route::get('/', [ArticleController::class, 'index']);
        Route::get('/{id}', [ArticleController::class, 'show']);
        Route::post('/', [ArticleController::class, 'store'])->middleware('permission:create-post');
        Route::put('/{id}', [ArticleController::class, 'update'])->middleware('permission:edit-post');
        Route::delete('/{id}', [ArticleController::class, 'destroy'])->middleware('permission:delete-post');
    });

    // If User is Admin

    Route::middleware('role:Admin')->group(function () {
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::post('{id}/assign-role', [UserController::class, 'assignRole']);
            Route::post('{id}/remove-role', [UserController::class, 'removeRole']);
            Route::post('{id}/assign-permission', [UserController::class, 'assignPermission']);
            Route::post('{id}/remove-permission', [UserController::class, 'removePermission']);
        });
        // Role Routes
        Route::apiResource('roles', RoleController::class);

        // Permission Routes
        Route::apiResource('permissions', PermissionController::class);

    });


});
