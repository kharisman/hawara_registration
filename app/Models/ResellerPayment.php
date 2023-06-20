<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResellerPayment extends Model
{
    use HasFactory;

    public function reseller()
    {
        return $this->belongsTo(Reseller::class,'reff','code_reff') ;
    }

    public function product()
    {
        return $this->belongsTo(ResellerProduct::class,'reseller_product_id','id') ;
    }
    
}
