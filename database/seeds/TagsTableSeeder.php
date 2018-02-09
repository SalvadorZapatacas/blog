<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::truncate();

        $tag = new Tag();
        $tag->name = "Etiqueta 1";
        $tag->save();

        $tag = new Tag();
        $tag->name = "Etiqueta 2";
        $tag->save();

        $tag = new Tag();
        $tag->name = "Etiqueta 3";
        $tag->save();

        $tag = new Tag();
        $tag->name = "Etiqueta 4";
        $tag->save();
    }
}
