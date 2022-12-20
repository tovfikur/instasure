<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DeviceSubcategory extends Model
{
    public function deviceCategory(){
        return $this->belongsTo('App\Model\DeviceCategory','device_category_id');
    }
}
