<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{

		use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function blogs(){
    	return $this->belongsToMany('App\Models\Blog');
    }

}
