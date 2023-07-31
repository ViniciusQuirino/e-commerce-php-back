<?php

namespace App\Services\Users;

use App\Exceptions\AppError;
use App\Mail\EmailForgetPassword;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

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

        Mail::to($user->email)->send(new EmailForgetPassword($user));
        return ['message' => 'email to reset password sent successfully'];
    }
}
