<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductBranch extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function product (){
        return $this->hasOne('App\Models\Product', 'uid', 'product_uid');
    }

    public function branch (){
        return $this->hasOne('App\Models\Branch', 'uid', 'branch_uid');
    }

    /*public function product_name()
    {
        return $this->belongsToMany(
            Product::class,
            ProductBranch::class,
            'product_uid',
            'uid',
        );
    }*/
}
