<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QRCustomer extends Model
{

    protected $table = 'qrcustomers';

    public function code (){
        return $this->hasOne('App\Models\QRCode', 'id', 'qrcode_id');
    }

    public function gift (){
        return $this->hasOne('App\Models\QRGift', 'id', 'qrgift_id');
    }
}
