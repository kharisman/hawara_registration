<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Gimmick extends Model
{

		use Sluggable;

		public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'gimmick_title'
            ]
        ];
    }

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
