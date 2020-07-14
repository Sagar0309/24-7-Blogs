<?php

use Illuminate\Database\Seeder;

use App\Permission;

use App\Role;

use App\User;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('permissions')->truncate();
        
        //curd post
            $curdPost=new Permission();
            $curdPost->name="curd-post";
            $curdPost->save();

        //update other post
            $updateOtherPost=new Permission();
            $updateOtherPost->name="update-other-post";
            $updateOtherPost->save();

        //delete other post
            $deleteOtherPost=new Permission();
            $deleteOtherPost->name="delete-other-post";
            $deleteOtherPost->save();

        //curd category
            $curdCategory=new Permission();
            $curdCategory->name="curd-category";
            $curdCategory->save();

        //curd user
            $curdUser=new Permission();
            $curdUser->name="curd-user";
            $curdUser->save();

         

        //  $curdPost=Permission::find(1);
        //  $updateOtherPost=Permission::find(2);
        //  $curdCategory=Permission::find(3);
        //  $curdUser=Permission::find(4);
        //  $deleteOtherPost=Permission::find(5);
         
         //get users
         $user4=User::find(4);
         $user1=User::find(1);
         $user2=User::find(2);
         $user5=User::find(5);


        //attach permission to the roles
        $admin=Role::find(1);
        $editor=Role::find(2);
        $author=Role::find(3);

         $admin->detachPermissions([$curdPost,$updateOtherPost,$curdCategory,$curdUser,$deleteOtherPost]);
         $admin->attachPermissions([$curdPost,$updateOtherPost,$curdCategory,$curdUser,$deleteOtherPost]);
         $editor->detachPermissions([$curdPost,$updateOtherPost,$curdCategory,$deleteOtherPost]);
         $editor->attachPermissions([$curdPost,$updateOtherPost,$curdCategory,$deleteOtherPost]);
         $author->detachPermissions([$curdPost]);
         $author->attachPermissions([$curdPost]);

        //attach permission to user
        $user4->detachPermissions([$curdPost,$updateOtherPost,$curdCategory,$curdUser,$deleteOtherPost]);
        $user4->attachPermissions([$curdPost,$updateOtherPost,$curdCategory,$curdUser,$deleteOtherPost]);
        $user1->detachPermissions([$curdPost,$updateOtherPost,$curdCategory,$deleteOtherPost]);
        $user1->attachPermissions([$curdPost,$updateOtherPost,$curdCategory,$deleteOtherPost]);
        $user2->detachPermissions([$curdPost]);
        $user2->attachPermissions([$curdPost]);
        $user5->detachPermissions([$curdPost]);
        $user5->attachPermissions([$curdPost]);
    }
}
