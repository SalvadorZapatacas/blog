<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;


class TagsController extends Controller
{


    public function show(Tag $tag)
    {
        /*
         * Se llama a posts() y se encadena con paginate
         */
        // Busca todos los posts por la categoria y que su fecha de publicacion sea inferior a hoy.
        $posts = $tag->posts()->published()->paginate();

        //$posts = $tag->posts()->paginate();

        $title = "Publicaciones de la etiqueta " . $tag->name ;

        return view('welcome', compact('posts','tag' , 'title'));
    }



}
