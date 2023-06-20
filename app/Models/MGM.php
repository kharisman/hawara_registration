<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MGM extends Model
{
    protected $table = 'mgm';

    protected $fillable = ['nama','prodi','semester','no_hp','instagram','rek1','rek2','rek3'];
}
