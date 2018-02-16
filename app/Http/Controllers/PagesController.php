<?php

namespace App\Http\Controllers;


use App\Post;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        //La consulta debe estar en el modelo, con scopes

        $posts =  Post::published()->paginate();

        return view('welcome',compact('posts'));
    }
}
