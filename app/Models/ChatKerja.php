<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatKerja extends Model
{
    public $timestamps = false;

    protected $table = 'click_ckerja';

    protected $fillable = ['tanggal','views'];
}
