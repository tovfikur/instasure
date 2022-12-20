<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'status',
        'meta_title',
        'meta_description',
    ];
    /**
     * Mutators for name attribute
     * @return name
     */
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }
    /**
     * Brand has many models relationship
     * @return DeviceModel
     */
    public function model()
    {
        return $this->hasMany(DeviceModel::class, 'brand_id');
    }
}
