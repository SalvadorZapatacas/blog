<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    protected $fillable = [
        'url',
        'post_id'
    ];

    /*
     * Para borrar de la bbdd y disco , sobreescribimos el boot
     */
    public static function boot()
    {
        parent::boot();
        /*
         * Esto se escuchará cuando se llame al método Delete en PhotosController
         */
        static::deleting(function($photo){
            Storage::disk('public')->delete($photo->url);
        });
    }
}
