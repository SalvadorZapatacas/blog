<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Se llama primero a la menos restrictiva con las claves foraneas para que no haya follones
         */
        $this->call(CategoriesTableSeeder::class);
        $this->call(PostsTableSeeder::class);
    }
}
