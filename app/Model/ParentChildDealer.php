<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ParentChildDealer extends Model
{
    public function parent()
    {
        return $this->belongsTo('App\Model\Dealer', 'parent_dealer_id');
    }
    public function child()
    {
        return $this->belongsTo('App\Model\Dealer', 'child_dealer_id');
    }
}
