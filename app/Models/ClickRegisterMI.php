<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClickRegisterMI extends Model
{
    public $timestamps = false;

    protected $table = 'click_rmi';

    protected $fillable = ['tanggal','views'];
}
