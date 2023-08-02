<?php

namespace App\Services\Users;

use App\Exceptions\AppError;
use App\Jobs\ResetPasswordEmail;
use App\Models\User;
use Illuminate\Support\Str;

class SendEmailPasswordService
{
    public function execute(array $validatedData)
    {
        $user = User::firstWhere('email', $validatedData['email']);

        if (is_null($user)) {
            throw new AppError("Esse email não existe", 404);
        }

        $data = [
            ...$user->toArray(),
            'token_forget_password' => Str::random(60)
        ];

        $user->update($data);

        ResetPasswordEmail::dispatch($user);

        return ['message' => 'email to reset password sent successfully'];
    }
}
