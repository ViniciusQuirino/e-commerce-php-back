<?php

namespace App\Services\Users;

use App\Exceptions\AppError;
use App\Models\User;

class DeleteUserService
{
    public function delete(string $userId)
    {
        $user = User::find($userId);

        if (is_null($user)) {
            throw new AppError('Usuário não encontrado', 404);
        }

        $user->delete();
    }
}
