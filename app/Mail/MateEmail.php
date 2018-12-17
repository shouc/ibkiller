<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MateEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($data, $subject)
    {
        $this->data = $data;
        $this->subject = $subject;
    }

    public function build()
    {
        $address = 'mate@ibkiller.com';
        $subject = $this->subject;
        $name = 'IBKiller';
        
        return $this->view('emails.' . $this->data)
                    ->from($address, $name)
                    ->subject($subject);
    }
}