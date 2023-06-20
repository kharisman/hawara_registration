<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimML extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'voting_data_tim';
}
