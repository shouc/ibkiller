<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct()
    {
        //aaa
    }

    public function build()
    {
        $address = 'support@ibkiller.com';
        $subject = 'Test 1';
        $name = 'IBKiller Support';
        
        return $this->view('emails.test')
                    ->from($address, $name)
                    ->subject($subject)
                    ->with([ 'message' ]);
    }
}