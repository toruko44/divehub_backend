<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AuthCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $authCode;

    public function __construct($authCode)
    {
        $this->authCode = $authCode;
    }

    public function build()
    {
        return $this->view('emails.auth_code')
                    ->with(['authCode' => $this->authCode])
                    ->subject('Dive Hub 認証コードメール');
    }
}
