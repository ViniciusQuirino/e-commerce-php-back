<?php

use App\Http\Controllers\Users\AuthController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/users', [UserController::class, 'createUser']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['jwt.verify'])->group(function () {
    Route::prefix('/auth')->group(function () {
        Route::get('/user/{id}', [UserController::class, 'retrieveUser'])->middleware('admin.verify');
        Route::patch('/user', [UserController::class, 'updateUser']);
        Route::delete('/user', [UserController::class, 'deleteUser']);
    });
});
