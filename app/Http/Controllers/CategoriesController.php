<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show(Category $category)
    {
        /*
         * Se llama a posts() y se encadena con paginate
         */

        // Busca todos los posts por la categoria y que su fecha de publicacion sea inferior a hoy.
        $posts = $category->posts()->published()->paginate();

        $title = "Publicaciones de la categoría " . $category->name ;

        return view('welcome', compact('posts','category' , 'title'));
    }






}
