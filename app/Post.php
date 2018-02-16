<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{

    protected $dates = [
      'published_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopePublished($query)
    {
        /*
         * No se pone el ->get()
         */
        $query->whereNotNull('published_at')
            ->where('published_at', '<' , Carbon::now())
            ->latest('published_at');
    }


    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;

        $this->attributes['slug'] = str_slug($title);
    }



    /*
     * Sobreescribimos para que no funcione, para el Model Binding con el slug y no con el ID
     */
    public function getRouteKeyName(){
        return 'slug';
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }


}
