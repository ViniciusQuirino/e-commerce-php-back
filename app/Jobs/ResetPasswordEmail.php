<?php

namespace App\Jobs;

use App\Mail\Email;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ResetPasswordEmail implements ShouldQueue
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
            <title>Redefinir Senha</title>
        </head>
        <body>
            <p>Olá {$this->user->name}!</p>
            <p>Você solicitou redefinir sua senha.</p>
            <p>Clique no link abaixo para redefinir sua senha:</p>
            <a href='https://vite-project-jade.vercel.app/forget-password/{$this->user->token_forget_password}'>Redefinir Senha</a>
            <p>Se você não solicitou a redefinição da senha, você pode ignorar este e-mail.</p>
        </body>
        </html>";

        $obMail = new Email;
        $obMail->sendEmail($address, $subject, $body);
    }
}
