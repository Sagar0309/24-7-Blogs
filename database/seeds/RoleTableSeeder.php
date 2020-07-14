<?php

use Illuminate\Database\Seeder;

use App\Role;

use App\User;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('roles')->truncate();
        //Create Admin role
        $admin=new Role();
        $admin->name="admin";
        $admin->display_name="Admin";
        $admin->save();
        //$admin=Role::find(1);

      //Editor Role
        $editor=new Role();
        $editor->name="editor";
        $editor->display_name="Editor";
        $editor->save();
        //$editor=Role::find(2);

      //Author Role
        $author=new Role();
        $author->name="author";
        $author->display_name="Author";
        $author->save();
        //$author=Role::find(3);

      //User 4 as Admin
       $user1=User::find(1);
       $user1->detachRole($admin);
       $user1->attachRole($admin);
    }
}
