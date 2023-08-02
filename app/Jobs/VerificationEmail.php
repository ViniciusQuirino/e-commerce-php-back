<?php

namespace App\Jobs;

use App\Mail\Email;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class VerificationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $user;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $address = $this->user->email;
        $subject = 'Verifique seu email';
        // Log::debug($this->user->name);
        $body = "<!DOCTYPE html>
        <html>
        <head>
            <title>Verificação de E-mail</title>
        </head>
        <body>
            <h2>Olá {$this->user->name}</h2>
            <p>Obrigado por se registrar. Por favor, clique no link abaixo para verificar seu endereço de e-mail:</p>
            <a href='http://localhost:5174/verify-email/{$this->user->email_verification_token}'>Verificar E-mail</a>
        </body>
        </html>";

        $obMail = new Email;
        $obMail->sendEmail($address, $subject, $body);
    }
}
