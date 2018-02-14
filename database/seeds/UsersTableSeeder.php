<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        //Storage::disk('public')->deleteDirectory();

        $user = new User();

        $user->name = "María Zapata Casales";
        $user->email = "maria@zapata.com";
        $user->password = bcrypt(123456);

        $user->save();
    }
}
