<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMI extends Model
{
    public $timestamps = false;

    protected $table = 'click_cmi';

    protected $fillable = ['tanggal','views'];
}
