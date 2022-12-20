<?php

namespace App\Model;

use App\Model\PolicyProvider;
use Illuminate\Database\Eloquent\Model;

class TravelInsPlansChart extends Model
{
    protected $appends = ['travel_days'];

    /**
     * Custom accessor for document path attribute
     * @return name
     */
    public function getTravelDaysAttribute($value)
    {
        return 5;
    }


    /**
     * Travel insurance plans chart belongs to travel insurance plans category
     */
    public function travelInsPlansCategory()
    {
        return $this->belongsTo(TravelInsPlansCategory::class, 'travel_ins_plans_category_id');
    }

    /**
     * Travel insurance plans chart belongs to policy provide
     */
    public function policyProvider()
    {
        return $this->belongsTo(PolicyProvider::class, 'policy_provider_id');
    }
}
