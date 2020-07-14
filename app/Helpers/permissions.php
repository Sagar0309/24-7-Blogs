<?php 

function check_user_permission($request ,$actionName=NULL, $id=NULL){
    //current user
    $curretUser=$request->user();

    //current action name
    if($actionName){
        $currentActionName=$actionName;
    }
    else{
        $currentActionName = $request->route()->getActionName();
    }
    list($controller,$method)=explode('@',$currentActionName);
    $controller=str_replace(["App\\Http\\Controllers\\Backend\\", "Controller"], "", $controller);

    //'create'=>['create','store'],
    //'update'=>['edit','update'],
    //'destroy'=>['destroy','restore','forceDestroy'],
    //'read'=>['index','view']
    $classesMap=[
        'Blog'=>'post',
        'Categories'=>'category',
        'Users'=>'user',
        'Tags'=>'tags'
    ];

    $curdPermissionMap=[
        'curd'=>['create','store','edit','update','destroy','restore','forceDestroy','index','view']
    ];

    foreach($curdPermissionMap as $permission => $methods)
    {
        if(in_array($method, $methods) && isset($classesMap[$controller]))
        {
            $className=$classesMap[$controller];
            if($className=='post' && in_array($method,['edit','update','destroy','forceDestroy'])){
                //if user has no permission of update other post or delete other post
                $id=!is_null($id)?$id:$request->route("blog");
                if($id &&(!$curretUser->isAbleTo('update-other-post') && !$curretUser->isAbleTo('delete-other-post'))){
                    $post=\App\Post::withTrashed()->find($id);
                    if($post->author_id !== $curretUser->id){
                        return false;
                    }
                }
            }
            elseif(! $curretUser->isAbleTo("{$permission}-{$className}")){
                //if user has not permission dont allow  next request
                return false;
            }
        break;
        }
    }

    return true;

}