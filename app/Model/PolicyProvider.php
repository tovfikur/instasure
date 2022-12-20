<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PolicyProvider extends Model
{
    protected $appends = ['logo_path'];

    /**
     * Custom accessor for logo path attribute
     * @return String logo path
     */
    public function getLogoPathAttribute($value)
    {
        return asset('uploads/policy_provider/logo' . '/' . $this->logo);
    }


    /**
     * Accessors for policy provide name
     */

    public function getCompanyNameAttribute($value)
    {
        return ucwords($value);
    }
}
