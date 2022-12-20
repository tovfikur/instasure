<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $visitor_info;
    private $type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($visitor_info, $type = null)
    {
        $this->visitor_info = $visitor_info;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Visitors Query Through Contact Page - ' . config('app.name');
        if (isset($this->type) && $this->type == 'partner') {
            $subject = 'Visitors Query Through Partner Program - ' . config('app.name');
        }
        return $this->subject($subject)->view('emails.contact_us_email');
    }
}
