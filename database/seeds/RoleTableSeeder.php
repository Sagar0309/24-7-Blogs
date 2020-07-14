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

        // $admin=Role::find(1);
        // $editor=Role::find(2);
        // $author=ROle::find(3);

        //User 4 as Admin
         $user4=User::find(4);
         $user4->detachRole($admin);
         $user4->attachRole($admin);

        //user 1 as editor
         $user1=User::find(1);
         $user1->detachRole($editor);
         $user1->attachRole($editor);

        //user 2 as author
           $user2=User::find(2);
           $user2->detachRole($author);
           $user2->attachRole($author);

        //user 5 as author
         $user5=User::find(5);
         $user5->detachRole($author);
         $user5->attachRole($author);
    }
}
