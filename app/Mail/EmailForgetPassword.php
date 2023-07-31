<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class EmailForgetPassword extends Mailable
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('emails.forgetPassword');
    }
}
