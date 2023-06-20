<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClickRegisterIF extends Model
{
    public $timestamps = false;

    protected $table = 'click_rif';

    protected $fillable = ['tanggal','views'];
}
