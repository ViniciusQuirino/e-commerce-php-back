<?php

namespace App\Services\Users;

use App\Exceptions\AppError;
use App\Mail\EmailVerification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CreateUserService
{
    public function execute(array $data)
    {
        if (stripos($data['email'], "gmail.com") !== false) {
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
            
            $result = [
                ...$data,
                'email_verification_token' => Str::random(60),
            ];

            $user = User::create($result);
            
            Mail::to($user->email)->send(new EmailVerification($user));

            return $user->toArray();
        } else {
            throw new AppError('A que a criação da conta só será permitida caso o endereço de email utilizado termine com "@gmail.com". Essa restrição foi estabelecida devido ao serviço de envios de email ser gratuito.', 400);
        }
    }
}
