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
        //DB::statement('SET FOREIGN_KEY_CHECKS=0');
        //DB::table('users')->truncate();
        DB::table('users')->delete();

        DB::table('users')->insert([
            [
                'name'=>"Admin",
                'email'=>"admin12@gmail.com",
                'password'=>bcrypt('secret'),
                'slug'=>"admin",
                'bio'=>"Access and moniter all accouts and category, tags, user"
            ]
        ]);
    }
}
