<?php

use Illuminate\Database\Seeder;

use App\Tag;

use App\Post;


class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $nonselected=new Tag();
        $nonselected->name="Non Selected";
        $nonselected->slug="nonselected";
        $nonselected->save();

    }
}
