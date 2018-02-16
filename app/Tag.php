<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{


    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;

        $this->attributes['url'] = str_slug($name);
    }


    public function getRouteKeyName()
    {
        return 'url';
    }
}
