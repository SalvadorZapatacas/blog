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
        $posts = $category->posts()->paginate();

        return view('welcome', compact('posts','category'));
    }






}
