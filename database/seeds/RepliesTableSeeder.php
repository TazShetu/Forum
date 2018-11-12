<?php

use Illuminate\Database\Seeder;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $r1 = [
            'body' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus.',
            'user_id' => 1,
            'discussion_id' => 1
        ];
        $r2 = [
            'body' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus.',
            'user_id' => 1,
            'discussion_id' => 2
        ];
        $r3 = [
            'body' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus.',
            'user_id' => 2,
            'discussion_id' => 3
        ];
        $r4 = [
            'body' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus.',
            'user_id' => 2,
            'discussion_id' => 4
        ];
        App\Reply::create($r1);
        App\Reply::create($r2);
        App\Reply::create($r3);
        App\Reply::create($r4);
    }
}
