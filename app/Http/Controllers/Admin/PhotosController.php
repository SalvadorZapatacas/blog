<?php

namespace App\Http\Controllers\Admin;

use App\Photo;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    //Inyección de dependencias Post $post
    public function store( Post $post)
    {
        $this->validate(request(), [
            'photo' => 'required|image|max:2048'
        ]);


        return request()->file('photo')->store('public');

        // El nombre viene del script de js la opcion "paramName" , public se refiere en config.app.disks
        $photo = request()->file('photo')->store('public');

        Photo::create([
            'url' => Storage::url($photo),
            'post_id' => $post->id
        ]);

    }

    public function destroy(Photo $photo)
    {
        $photo->delete();

        $photoPath = str_replace('storage' , 'public' , $photo->url);

        Storage::delete($photoPath);

        return back()->with('flash' , 'Foto eliminada');
    }
}
