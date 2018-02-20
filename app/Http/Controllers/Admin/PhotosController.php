<?php

namespace App\Http\Controllers\Admin;

use App\Photo;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotosController extends Controller
{
    //Inyección de dependencias Post $post
    public function store( Post $post)
    {
        $this->validate(request(), [
            'photo' => 'required|image|max:2048'
        ]);


        // El nombre viene del script de js la opcion "paramName" , public se refiere en config.app.disks
        // Guardamos en posts , dentro del disco public

        //$photo = request()->file('photo')->store('public');

        $post->photos()->create([
            'url' =>  request()->file('photo')->store('posts','public')
        ]);

        /*
        Photo::create([
            'url' =>  request()->file('photo')->store('public'),
            'post_id' => $post->id
        ]);
        */

    }

    public function destroy(Photo $photo)
    {
        $photo->delete();
        //
        //$photoPath = str_replace('storage' , 'public' , $photo->url);
        return back()->with('flash' , 'Foto eliminada');
    }
}
