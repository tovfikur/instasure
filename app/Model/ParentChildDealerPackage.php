<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ParentChildDealerPackage extends Model
{
    public function childDealer(){
        return $this->belongsTo('App\Model\Dealer','child_id');
    }
}
