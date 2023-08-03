<?php

namespace App\Services\Users;

use App\Exceptions\AppError;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Mockery\Undefined;

class VerifyEmailService
{
    public function execute(string $token)
    {
        $listaSubstrings = explode('.', $token);

        Log::debug($listaSubstrings);

        if (count($listaSubstrings) < 2) {
            throw new AppError("Token ou id inválido", 403);
        } else {
            $user = User::where('id', $listaSubstrings[1])
                ->orWhere('email_verification_token', $listaSubstrings[0])->first();

            if (!$user) {
                throw new AppError('Não foi possível fazer a verificação do email. Token ou id inválido', 404);
            } else if ($user->email_verified == true) {
                return $user;
            }

            $user->email_verified = true;
            $user->email_verification_token = null;
            $user->save();

            return $user;
        }
    }
}
