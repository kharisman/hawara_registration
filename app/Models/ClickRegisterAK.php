<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClickRegisterAK extends Model
{
    public $timestamps = false;

    protected $table = 'click_rak';

    protected $fillable = ['tanggal','views'];
}
