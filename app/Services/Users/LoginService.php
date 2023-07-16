<?php

namespace App\Services\Users;

use App\Exceptions\AppError;

class LoginService
{
    public function execute(array $data)
    {
        //Verificar se existe o usuario com esse email ou senha
        //auth == middleware
        if (!$token = auth()->attempt($data)) {
            throw new AppError("Email ou senha incorretos", 401);
        }

        return $this->responseToken($token);
    }

    private function responseToken($token)
    {
        return response()->json([
            'user' => auth()->user(),
            'token' => $token
        ], 201);
    }
}
