<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatSI extends Model
{
    public $timestamps = false;

    protected $table = 'click_csi';

    protected $fillable = ['tanggal','views'];
}
