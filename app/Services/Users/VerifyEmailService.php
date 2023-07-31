<?php

namespace App\Services\Users;

use App\Exceptions\AppError;
use App\Models\User;

class VerifyEmailService
{
    public function execute(string $token)
    {
        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            throw new AppError('Invalid verification token', 404);
        }

        $user->email_verified = true;
        $user->email_verification_token = null;
        $user->save();

        return ['message' => 'email successfully verified'];
    }
}
