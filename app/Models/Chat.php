<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public $timestamps = false;

    protected $table = 'click_chat';

    protected $fillable = ['tanggal','views'];
}
