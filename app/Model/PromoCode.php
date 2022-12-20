<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    public function deviceCategory(){
        return $this->belongsTo('App\Model\DeviceCategory','device_category_id');
    }
    public function deviceSubcategory(){
        return $this->belongsTo('App\Model\DeviceSubcategory','device_subcategory_id');
    }
    public function deviceBrand(){
        return $this->belongsTo('App\Model\Brand','device_brand_id');
    }
    public function deviceModel(){
        return $this->belongsTo('App\Model\DeviceModel','device_model_id');
    }
    public function parentDealer(){
        return $this->belongsTo('App\Model\Dealer','parent_id');
    }
}
