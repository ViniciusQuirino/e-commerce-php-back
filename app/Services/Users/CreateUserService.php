<?php

namespace App\Services\Users;

use App\Exceptions\AppError;
use App\Jobs\VerificationEmail;
use App\Mail\Email;
use App\Models\User;
use Illuminate\Support\Str;

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

        $result = [
            ...$user->toArray(),
            'email_verified' => false,
            'email_verification_token' => Str::random(60) . '.' . $user->id,
        ];

        $user->update($result);

        VerificationEmail::dispatch($user);

        return $user->toArray();
    }
}
