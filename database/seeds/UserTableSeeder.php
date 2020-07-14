<?php

use Illuminate\Database\Seeder;



class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        

        DB::table('users')->insert([
            [
                'name'=>"John Doe",
                'email'=>"johndoe@stat.com",
                'password'=>bcrypt('secret')
            ],
            [
                'name'=>"Mathw Strike",
                'email'=>"mathwst@lua.com",
                'password'=>bcrypt('secret')
            ],
            [
                'name'=>"Keran paige",
                'email'=>"keranp@itln.com",
                'password'=>bcrypt('secret')
            ]
        ]);
    }
}
