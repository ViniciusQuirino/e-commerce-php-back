<?php

namespace App\Services\Users;

use App\Exceptions\AppError;
use App\Models\User;

class RetrieveUserService
{
    public function execute(string $id)
    {
        $userFound = User::find($id);

        if (is_null($userFound)) {
            throw new AppError("Usuário não encontrado", 404);
        }

        return $userFound;
    }
}
