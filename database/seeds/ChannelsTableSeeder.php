<?php

use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $c1 = ['title' => 'Laravel Test', 'slug' => str_slug('Laravel')];
        $c2 = ['title' => 'PHP 7.2', 'slug' => str_slug('PHP 7.2')];
        $c3 = ['title' => 'Js is best', 'slug' => str_slug('Js is best')];
        $c4 = ['title' => 'C# also needed', 'slug' => str_slug('C# also needed')];
        $c5 = ['title' => 'Node.Js is no 1', 'slug' => str_slug('Node.Js is no 1')];

        App\Channel::create($c1);
        App\Channel::create($c2);
        App\Channel::create($c3);
        App\Channel::create($c4);
        App\Channel::create($c5);
    }
}
