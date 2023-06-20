<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function product_branch (){
        return $this->hasMany('App\Models\ProductBranch', 'uid', 'product_branch_id');
    }
}
