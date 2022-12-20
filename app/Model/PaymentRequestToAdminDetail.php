<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentRequestToAdminDetail extends Model
{
    protected $fillable = [
        'payment_request_to_admin_id', 'claim_payment_request_id'
    ];

    /**
     * Relationship
     *
     */

    public function claim_payment_requests()
    {
        return $this->belongsTo(ClaimPaymentRequest::class, 'claim_payment_request_id');
    }
}
