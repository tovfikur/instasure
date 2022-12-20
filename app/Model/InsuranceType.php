<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InsuranceType extends Model
{
    public function deviceSubcategory(){
        return $this->belongsTo('App\Model\DeviceSubcategory','device_subcategory_id');
    }
}
