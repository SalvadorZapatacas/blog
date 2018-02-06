<?php

namespace App\Http\Controllers;


use App\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        //Utilizamos latest , funcion de Eloquent
        $posts =  Post::latest('published_at')->get();
        return view('welcome',compact('posts'));
    }
}
