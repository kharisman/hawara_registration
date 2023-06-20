<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Conner\Tagging\Taggable;

class Links extends Model
{
    use Taggable;

    protected $table = 'links';
}
