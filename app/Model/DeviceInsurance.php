<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DeviceInsurance extends Model
{
    protected $appends = ['_pay_status'];

    /**
     * Custom accessor for payment status attribute
     * @return name
     */
    public function getPayStatusAttribute()
    {
        $status_text = null;
        $imei = ImeiData::with('mobile_diagnosis')->where(['imei_1' => $this->imei_one])->first();
        if (isset($imei->mobile_diagnosis)) {
            $is_expired = is_expired($imei->mobile_diagnosis->validity_period);

            if (strtolower($this->payment_status) == 'pending' && empty($is_expired)) {
                $status_text = 'Canceled';
            }
        }

        return $status_text;
    }

    /**
     * Device insurance has many device claims Relationship
     */
    public function device_claims()
    {
        return $this->hasMany(DeviceClaim::class, 'device_insurance_id');
    }

    /**
     * Device insurance belongs to parent dealer relationship
     */
    public function parent()
    {
        return $this->belongsTo(Dealer::class, 'parent_dealer_id');
    }

    /**
     * Device insurance belongs to child dealer relationship
     */
    public function childDealer()
    {
        return $this->belongsTo(Dealer::class, 'child_dealer_id');
    }

    /**
     * Device insureace belongs to package
     */
    public function package()
    {
        return $this->belongsTo(InsurancePackage::class, 'package_id');
    }

    /**
     * Device insureace has many device insurace details
     */
    public function device_insurace_details()
    {
        return $this->hasMany(DeviceInsuranceDetails::class);
    }

    /**
     * Device insureace has many device insurace details
     */
    public function device_claim_requests()
    {
        return $this->hasMany(DeviceClaimRequest::class, 'device_insurance_id');
    }
}
