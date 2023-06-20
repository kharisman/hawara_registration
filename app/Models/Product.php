<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function category (){
        return $this->hasOne('App\Models\Category', 'uid', 'category_uid');
    }

    public function branch (){
        return $this->hasMany('App\Models\Branch', 'uid', 'branch_uid');
    }

    /*public function product_option()
    {
        return $this->hasManyThrough(
            ProductBranchOption::class,
            ProductBranch::class,
            'product_uid',
            'product_branch_uid',
        );
    }*/
}
