<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeviceInsuranceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'payment_status' => $this->payment_status,
            'policy_number' => $this->policy_number,
            'should_pay' => $this->grand_total < 0 ? ['status' => true, 'title' => 'Pay Now'] : ['status' => false, 'title' => 'Disbursed Now'],
            'download_certificate' => $this->payment_status == 'pending' ? false : true,
            'customer_info' => json_decode($this->customer_info),
            'device_info' => json_decode($this->device_info),
            'insurance_type_value' => json_decode($this->insurance_type_value),
            'claimable_amount' => $this->claimable_amount . ' ' . config('settings.currency'),
            'claimed_amount' => $this->claimed_amount . ' ' . config('settings.currency'),
            'sub_total' => $this->sub_total . ' ' . config('settings.currency'),
            'total_vat' => $this->total_vat . ' ' . config('settings.currency'),
            'total_discount' => $this->total_discount . ' ' . config('settings.currency'),
            'grand_total' => $this->grand_total . ' ' . config('settings.currency'),
            'activation_date' => date_format_custom($this->created_at, 'F d, Y'),
            'expire_date' => dateFormat(insExpireDate($this)),
            'remaining_days' => insRemainingDays($this)
        ];
    }
}
