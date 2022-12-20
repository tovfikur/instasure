<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ServiceCenterDetails extends Model
{
    /**
     * Mutators for parts_name attribute
     * @return name
     */
    public function getServiceCenterNameAttribute($value)
    {
        return ucwords($value);
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function division()
    {
        return $this->belongsTo('App\Model\Division', 'division_id');
    }
    public function district()
    {
        return $this->belongsTo('App\Model\District', 'district_id');
    }
    public function upazila()
    {
        return $this->belongsTo('App\Model\Upazila', 'upazila_id');
    }
}
