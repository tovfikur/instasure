<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeviceInsurancePurchaseEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $policyId;
    public $startDate;
    public $endDate;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($policyId, $startDate, $endDate)
    {
        $this->policyId = $policyId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->password = 123456;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.device_insurance_purchase_email')
            ->from(env('MAIL_FROM_ADDRESS'))
            ->subject(env('CUSTOMER_DEVICE_INSURANCE_MAIL_SUBJECT'));
    }
}
