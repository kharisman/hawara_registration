<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatAK extends Model
{
    public $timestamps = false;

    protected $table = 'click_cak';

    protected $fillable = ['tanggal','views'];
}
