<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClickRegisterSI extends Model
{
    public $timestamps = false;

    protected $table = 'click_rsi';

    protected $fillable = ['tanggal','views'];
}
