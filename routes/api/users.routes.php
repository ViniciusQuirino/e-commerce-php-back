<?php

use App\Http\Controllers\Users\AuthController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/users', [UserController::class, 'createUser']);
Route::post('/login', [AuthController::class, 'login']);
//verificação de email
Route::get('/verify-email/{token}', [UserController::class, 'verifyEmail']);
//enviar email para recuperação de senha
Route::post('/forget-password/email',[UserController::class, 'sendResetLinkEmail']);
//resetar a senha
Route::post('/forget-password/reset/{token}',[UserController::class, 'reset']);

Route::middleware(['jwt.verify'])->group(function () {
    Route::prefix('/auth')->group(function () {
        Route::get('/user', [UserController::class, 'retrieveUser']);
        Route::patch('/user', [UserController::class, 'updateUser']);
        Route::delete('/user', [UserController::class, 'deleteUser']);
    });
});
