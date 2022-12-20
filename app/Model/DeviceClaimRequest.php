<?php

namespace App\Model;

use App\User;

use Illuminate\Database\Eloquent\Model;

class DeviceClaimRequest extends Model
{
    /**
     * Device Claim Request Belongs to customer
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * Device Claim Request Belongs to Device Insurance Relationship
     */
    public function serviceCenter()
    {
        return $this->belongsTo(ServiceCenterDetails::class, 'sc_user_id');
    }

    /**
     * Device Claim Request Belongs to service center
     */
    public function service_center()
    {
        return $this->belongsTo(ServiceCenterDetails::class, 'service_center_id');
    }
    /**
     * Device Claim Request Belongs to Device Insurance Relationship
     */
    public function deviceInsurance()
    {
        return $this->belongsTo(DeviceInsurance::class, 'device_insurance_id');
    }
}
