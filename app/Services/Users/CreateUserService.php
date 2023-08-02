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

        $result = [
            ...$data,
            'email_verification_token' => Str::random(60),
        ];

        $user = User::create($result);
        // VerificationEmail::dispatch($user);

        $address = $user->email;
        $subject = 'Verifique seu email';
        // Log::debug($user->name);
        $body = "<!DOCTYPE html>
        <html>
        <head>
            <title>Verificação de E-mail</title>
        </head>
        <body>
            <h2>Olá {$user->name}</h2>
            <p>Obrigado por se registrar. Por favor, clique no link abaixo para verificar seu endereço de e-mail:</p>
            <a href='https://vite-project-jade.vercel.app/verify-email/{$user->email_verification_token}'>Verificar E-mail</a>
        </body>
        </html>";

        $obMail = new Email;
        $sucesso = $obMail->sendEmail($address, $subject, $body);
        echo $sucesso ? "Mensagem enviada com sucesso!" : $obMail->getError();

        return $user->toArray();
    }
}
