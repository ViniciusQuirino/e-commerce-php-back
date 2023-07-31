<?php

namespace App\Services\Users;

use App\Exceptions\AppError;
use App\Models\User;

class ResetPasswordService
{
    public function execute(array $validatedData, string $token)
    {
        $user = User::where('token_forget_password', $token)->first();

        if (!$user) {
            throw new AppError('Invalid verification token', 404);
        }

        $data = [
            ...$user->toArray(),
            'password' => $validatedData['password'],
            'token_forget_password' => null
        ];

        $user->update($data);
        return ['message' => 'successfully updated password'];
    }
}
