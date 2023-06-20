<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatDKV extends Model
{
    public $timestamps = false;

    protected $table = 'click_cdkv';

    protected $fillable = ['tanggal','views'];
}
