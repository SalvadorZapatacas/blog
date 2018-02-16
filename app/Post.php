<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    protected $fillable = [
      'title',
      'body',
      'iframe',
      'excerpt',
      'published_at',
      'category_id'
    ];

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

    public function setPublishedAtAttribute($published_at)
    {
        /*
         * Si ponemos eso , en vez de nula lo que hace es poner la fecha de hoy
         */
        $this->attributes['published_at'] = $published_at ? Carbon::parse($published_at) : null;
    }

    public function setCategoryIdAttribute($category_id)
    {
        $this->attributes['category_id'] = Category::find($cat = $category_id)
                                            ? $cat
                                            : Category::create(['name' => $cat])->id;
    }

    public function syncTags($tags)
    {
        /*
         * Creamos una colección y con map recorremos una a una las etiquetas y ya las creamos o las devolvemos
         */

        $tagIds = $tags = collect($tags)->map(function($tag){
            return Tag::find($tag) ? $tag : Tag::create(['name' => $tag])->id;
        });

        /*
         * Nos basamos en la relacion y con attach o sync se lo añadimos ( mirar docs )
         */

        return $this->tags()->sync($tagIds);
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
