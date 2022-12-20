<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;

class Message extends Model
{

    protected $fillable = ['message'];
    /**
     * Relationship
     *
     */

    public function messageable()
    {
        return $this->morphTo()->withTimestamps();
    }
}
