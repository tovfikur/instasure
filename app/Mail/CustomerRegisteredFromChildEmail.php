<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerRegisteredFromChildEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $phone;
    public $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($phone)
    {
        $this->phone = $phone;
        $this->password = 123456;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.customer_registered_from_child')
            ->from(env('MAIL_FROM_ADDRESS'))
            ->subject(env('CUSTOMER_REGISTERED_MAIL_SUBJECT'));
    }
}
