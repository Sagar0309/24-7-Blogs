<?php
namespace App\Views\Composer;
use Illuminate\View\View;
use App\category;
use App\Post;
class NavigationComposer
{
    public function compose(View $view){
        $this->composeCategories($view);
        $this->composePopularPost($view);
    }
    private function composeCategories(View $view){
        $categories=category::with(['posts'=>function($query){
            $query->published();
        }])->orderBy('title','asc')->get();

        $view->with('categories', $categories);
    }

    private function composePopularPost(View $view){
        $popularPosts=Post::published()->popular()->take(3)->get();
        $view->with('popularPosts', $popularPosts);
    }
}