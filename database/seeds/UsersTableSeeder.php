<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'ADMIN',
            'email' => 'a@g.com',
            'password' => bcrypt('123456'),
            'admin' => 1,
//            'avatar' => asset('avatars/avatarw.jpg')
        // use asset() when we have a domain like taz.com
            // asset() will save file as taz.com/avatars/*.jpg
            'avatar' => 'avatars/avatarw.jpg'
        ]);
        App\User::create([
            'name' => 'TAZ',
            'email' => 't@g.com',
            'password' => bcrypt('123456'),
//            'avatar' => asset('avatars/avatar.png')
            'avatar' => 'avatars/avatar.png'
        ]);

    }
}
