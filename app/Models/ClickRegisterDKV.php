<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClickRegisterDKV extends Model
{
    public $timestamps = false;

    protected $table = 'click_rdkv';

    protected $fillable = ['tanggal','views'];
}
