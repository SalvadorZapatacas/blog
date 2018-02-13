<?php

namespace App\Http\Controllers\Admin;

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

        // El nombre viene del script de js la opcion "paramName"
        $photo = request()->file('photo');
        //public se refiere en config.app.disks
        $photo->store('public');

        return "Procesando imágenes";
    }
}
