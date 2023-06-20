<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Blog extends Model
{
    use Sluggable;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'blog_title'
            ]
        ];
    }

    public function tags(){
        return $this->hasMany('App\Models\Tag', 'uid', 'tag_uid');
    }

    public function user(){
        return $this->hasOne('App\Models\User', 'uid', 'user_uid');
    }

    public function category(){
        return $this->hasOne('App\Models\BlogCategory', 'uid', 'blog_category_uid');
    }

    public function setTag($value)
    {
        $this->attributes['tags'] = json_encode($value);
    }

    public function getTag($value)
    {
        return $this->attributes['tags'] = json_decode($value);
    }
}
