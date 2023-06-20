<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductBranchOption extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function product_branch (){
        return $this->belongsTo('App\Models\ProductBranch', 'product_branch_uid', 'uid');
    }

    public function product()
    {
        return $this->hasManyThrough(
            ProductBranchOption::class,
            ProductBranch::class,
            'product_uid',
            'product_branch_uid',
        );
    }
}
