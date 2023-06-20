<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QRCode extends Model
{
    use SoftDeletes;

    protected $table = 'qrcodes';

    public function merchant (){
        return $this->hasOne('App\Models\QRMerchant', 'id', 'qrmerchant_id');
    }
}
