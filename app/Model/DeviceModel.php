<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DeviceModel extends Model
{
    protected $fillable = [
        'brand_id',
        'name',
        'slug',
        'status',
        'description',
    ];
    /**
     * Device model belongs to brand relationship
     * @return Brand
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    /**
     * Device model has many parts relationship
     * @return Part $parts
     */
    public function parts()
    {
        return $this->hasMany(Part::class, 'model_id');
    }
}
