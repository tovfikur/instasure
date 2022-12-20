<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class DeviceClaim extends Model
{
    protected $appends = ['document_path'];

    /**
     * Custom accessor for document path attribute
     * @return name
     */
    public function getDocumentPathAttribute($value)
    {
        return array_map(fn ($document) =>  asset('uploads/claim/document' . '/' . $document), json_decode($this->document));
    }

    /**
     * Accessor for parts_name attribute
     * @return name
     */
    public function getStatusAttribute($value)
    {
        return ucwords($value);
    }


    /**
     * Accessor for parts_name attribute
     * @return name
     */
    public function getStatusNoteAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * Accessor for payment_status attribute
     * @return name
     */

    public function getPaymentStatusAttribute($value)
    {
        return ucwords($value);
    }
    /**
     * Get the user that owns the device claim.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the device claimed parts that owns the device claim.
     */

    public function device_claimed_parts()
    {
        return $this->hasMany(DeviceClaimedPart::class, 'device_claim_id');
    }
    /**
     *  Device claims depends on device insurance relation
     */

    public function device_insurance()
    {
        return $this->belongsTo(DeviceInsurance::class, 'device_insurance_id');
    }

    /**
     *  Device claims depends on device insurance relation
     */

    public function service_center()
    {
        return $this->belongsTo(ServiceCenterDetails::class, 'service_center_id');
    }
}
