<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('permissions',PermissionController::class);
Route::apiResource('roles',RoleController::class);
Route::post('/roles/{id}/permission', [RoleController::class, 'getPermissions']);
Route::apiResource('posts', PostController::class);
