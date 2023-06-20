<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClickRegister extends Model
{
    public $timestamps = false;

    protected $table = 'click_register';

    protected $fillable = ['tanggal','views'];
}
