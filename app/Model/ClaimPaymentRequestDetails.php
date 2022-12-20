<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ClaimPaymentRequestDetails extends Model
{
    /**
     * Get the device claim that owns the payment.
     */
    public function device_claims()
    {
        return $this->belongsTo(DeviceClaim::class, 'claim_id');
    }
}
