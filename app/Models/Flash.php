<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flash extends Model
{
    protected $table = 'flash';

    public function pay(){
        return $this->hasOne('App\Models\Payment', 'registration_uid', 'phone1');
    }
}
