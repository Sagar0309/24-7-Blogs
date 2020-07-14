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

    //curd user
        $curdTag=new Permission();
        $curdTag->name="crud-tags";
        $curdTag->save();

         

        $user1=User::find(1);
         


        $admin=Role::whereName('admin')->first();
        $editor=Role::whereName('editor')->first();
        $author=Role::whereName('author')->first();

         $admin->detachPermissions([$curdPost,$updateOtherPost,$curdCategory,$curdUser,$deleteOtherPost,$curdTag]);
         $admin->attachPermissions([$curdPost,$updateOtherPost,$curdCategory,$curdUser,$deleteOtherPost,$curdTag]);
         $editor->detachPermissions([$curdPost,$updateOtherPost,$curdCategory,$deleteOtherPost,$curdTag]);
         $editor->attachPermissions([$curdPost,$updateOtherPost,$curdCategory,$deleteOtherPost,$curdTag]);
         $author->detachPermissions([$curdPost]);
         $author->attachPermissions([$curdPost]);

        //attach permission to user
        $user1->detachPermissions([$curdPost,$updateOtherPost,$curdCategory,$curdUser,$deleteOtherPost,$curdTag]);
        $user1->attachPermissions([$curdPost,$updateOtherPost,$curdCategory,$curdUser,$deleteOtherPost,$curdTag]);
    }
}
