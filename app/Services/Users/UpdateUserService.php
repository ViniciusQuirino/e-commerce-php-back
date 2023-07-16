<?php

namespace App\Services\Users;

use App\Models\User;

class UpdateUserService
{
    public function execute(array $data, string $userId)
    {
        $user = User::find($userId);

        if ($user) {
            $user->update($data);

            return $user;
        }
    }
}
