<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClickRegisterKerja extends Model
{
    public $timestamps = false;

    protected $table = 'click_rkerja';

    protected $fillable = ['tanggal','views'];
}
