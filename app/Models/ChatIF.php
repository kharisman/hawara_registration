<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatIF extends Model
{
    public $timestamps = false;

    protected $table = 'click_cif';

    protected $fillable = ['tanggal','views'];
}
