<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function show(Post $post)
    {
        //No hace falta esto ya porque estamos utilizando el Model Binding
        //$post = Post::findOrFail($id);

        return view('posts.show',compact('post'));
    }
}
