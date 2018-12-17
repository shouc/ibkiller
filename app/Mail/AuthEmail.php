<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AuthEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($session, $subject)
    {
        $this->session = $session;
        $this->subject = $subject;
    }

    public function build()
    {
        $address = 'auth@ibkiller.com';
        $subject = $this->subject;
        $name = 'IBKiller Support';
        
        return $this->view('emails.auth')
                    ->from($address, $name)
                    ->subject($subject)
                    ->with(['session' => $this->session]);
    }
}