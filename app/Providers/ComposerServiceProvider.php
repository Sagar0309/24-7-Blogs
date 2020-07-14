<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\category;

use App\Views\Composer\NavigationComposer;

use App\Post;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('layouts.sidebar', NavigationComposer::class);
        // view()->composer('layouts.sidebar',function($view){
        //     $categories=category::with(['posts'=>function($query){
        //         $query->published();
        //     }])->orderBy('title','asc')->get();

        //     return $view->with('categories', $categories);
        // });

        // view()->composer('layouts.sidebar', function($view){
        //     $popularPosts=Post::published()->popular()->take(3)->get();
        //     return $view->with('popularPosts', $popularPosts);
        // });

    }
}
