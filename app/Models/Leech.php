<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leech extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function product (){
        return $this->hasOne('App\Models\Product','uid','product_uid');
    }

    public function branch (){
        return $this->hasOne('App\Models\Branch','uid','branch_uid');
    }
}
