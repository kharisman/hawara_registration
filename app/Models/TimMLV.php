<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimMLV extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'voting_data_vote';

    public function tim()
{
    return $this->belongsTo(TimML::class, 'tim_id', 'id');
}
}
