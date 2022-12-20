<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InsurancePrice extends Model
{
    public function insuranceType(){
        return $this->belongsTo('App\Model\InsuranceType','insurance_type_id');
    }
}
