<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InsurancePackage extends Model
{
    public function deviceCategory()
    {
        return $this->belongsTo('App\Model\DeviceCategory', 'device_category_id');
    }
    public function deviceSubcategory()
    {
        return $this->belongsTo('App\Model\DeviceSubcategory', 'device_subcategory_id');
    }
    public function deviceBrand()
    {
        return $this->belongsTo('App\Model\Brand', 'brand_id');
    }
    public function deviceModel()
    {
        return $this->belongsTo('App\Model\DeviceModel', 'device_model_id');
    }
    public function parentDealer()
    {
        return $this->belongsTo('App\Model\Dealer', 'parent_id');
    }
    /**
     * Device insurance package belongs to policy provide
     */
    public function policy_provider()
    {
        return $this->belongsTo(PolicyProvider::class, 'insurance_provider_id');
    }
    /**
     * Device insurance package belongs to insurance category
     */
    public function insurance_category()
    {
        return $this->belongsTo(Category::class, 'insurance_category_id');
    }
}
