<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagsController extends Controller
{


    public function show(Tag $tag)
    {
        /*
         * Se llama a posts() y se encadena con paginate
         */
        $posts = $tag->posts()->paginate();

        $title = "Publicaciones de la categoría" . $tag->name ;

        return view('welcome', compact('posts','tag' , 'title'));
    }



}
