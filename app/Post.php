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
      'category_id',
      'user_id'
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

    public function owner()
    {
        return $this->belongsTo(User::class ,'user_id');
    }

    public static function create(array $attributes = [])
    {
        $post  = static::query()->create($attributes);
        $post->generateSlug();


        return $post;
    }

    public function generateSlug()
    {
        $slug = str_slug($this->title);

        //Tambien se puede poner ->whereSlug($slug)

        if($this->where('slug',$slug)->exists()){
            $slug .= '-' . $this->id;
        }
        $this->slug = $slug;

        $this->save();
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

/*
    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;

        $this->attributes['slug'] = str_slug($title);
    }
*/

    public function isPublished()
    {
        return ! is_null($this->published_at) && $this->published_at < today();
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

    public static function boot()
    {
        parent::boot();

        static::deleting(function($post){
            /*
             * Con parentesis es que quieres hacer algo
             * Sin parentesis es que quieres sacarlas
             */
            $post->tags()->detach();

            $post->photos->each->delete();
        });
    }

    public function viewType($view = '')
    {
        if($this->photos->count() === 1){
            return 'posts.photo';
        }elseif($this->photos->count() > 1){
             return 'posts.carousel' . $view;
        }elseif($this->iframe) {
            return 'posts.iframe';
        }else{
            return 'posts.text';
        }
    }


}
