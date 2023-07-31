<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class EmailVerification extends Mailable
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('emails.verify');
    }
}
