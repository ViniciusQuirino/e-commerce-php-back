<?php

namespace App\Services\Users;

use App\Exceptions\AppError;
use App\Models\User;

class CreateUserService
{
    public function execute(array $data)
    {

        $userFound = User::firstWhere("email", $data['email']);

        if (!is_null($userFound)) {
            throw new AppError('EMAIL já cadastrado', 400);
        }

        $userFound = User::firstWhere("cpf", $data['cpf']);

        if (!is_null($userFound)) {
            throw new AppError('CPF já cadastrado', 400);
        }

        //transformar em maiusculo
        $data['type'] = isset($data['type']) ? strtoupper($data['type']) : 'CLIENTE';

        $user = User::create($data);

        return $user->toArray();
    }
}
