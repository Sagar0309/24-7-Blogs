<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if(env('APP_ENV')==='local'){
            $this->call(UserTableSeeder::class);
            $this->call(PostsTableSeeder::class);
            $this->call(RoleTableSeeder::class);
            $this->call(PermissionsTableSeeder::class);
            $this->call(TagTableSeeder::class);
        }else{
            $this->call(UserTableSeeder::class);
            $this->call(RoleTableSeeder::class);
            $this->call(PermissionsTableSeeder::class);
            $this->call(TagTableSeeder::class);
        }
    }
}
