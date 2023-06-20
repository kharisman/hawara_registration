<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QRGift extends Model
{
    use SoftDeletes;

    protected $table = 'qrgifts';

    public function merchant(){
        return $this->hasOne('App\Models\QRMerchant', 'id', 'qrmerchant_id');
    }
}
