<?php

namespace App\Http\Controllers;

use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function show(Post $post)
    {
        //No hace falta esto ya porque estamos utilizando el Model Binding
        //$post = Post::findOrFail($id);
/*
        if(!is_null($post->published_at)){
            if($post->published_at < Carbon::now()){
                return view('posts.show',compact('post'));
            }else{
                if(Auth::check()){
                    return view('posts.show',compact('post'));
                }else{
                    dd('No estas autenticado');
                }
            }
        }else{
            dd('no esta publicado');
        }

        dd('llegas aqui');
*/

        if($post->isPublished() || auth()->check()){
            return view('posts.show',compact('post'));
        }

        abort(404);

    }
}
