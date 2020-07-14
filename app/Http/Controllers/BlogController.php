<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

use App\category;

use Carbon\Carbon;

use App\User;

use App\Tag;

class BlogController extends Controller
{
    //
    protected $limit=3;
    public function index(){

        // $categories=category::with('posts')->orderBy('title','asc')->get();
        //\DB::enableQueryLog();
        $posts=Post::with('author')->latestFirst()->published();

        //chech if any term entered
        if($term=request('term')){
            $posts->where(function($q) use ($term){
                $q->whereHas('author', function($qr) use ($term){
                    $qr->where('name','LIKE',"%{$term}%");
                });
                $q->orwhereHas('category', function($qr) use ($term){
                    $qr->where('title','LIKE',"%{$term}%");
                });
                $q->where('title','LIKE',"%{$term}%");
                $q->orWhere('excerpt','LIKE',"%{$term}%");
            });
        }
        $posts=$posts->simplePaginate($this->limit);
        return view("blog.index",compact('posts'));
        //dd(\DB::getQueryLog());
    }

    public function category(category $category){

        $categoryName=$category->title;
        // $categories=category::with(['posts'=>function($query){
        //     $query->published();
        // }])->orderBy('title','asc')->get();

        // $posts=Post::with('author')->latestFirst()->published()->where('category_id',$id)->simplePaginate($this->limit);
        $posts=$category->posts()->with('author')->latestFirst()->published()->simplePaginate($this->limit);
        return view("blog.index",compact('posts','categoryName'));
    }

    public function show(Post $post){
        $post->increment('view_count');
        //$tags=$post->tags()->get();
        return view("blog.show", compact('post'));
    }

    public function author(User $author){
        $authorName=$author->name;
        // $categories=category::with(['posts'=>function($query){
        //     $query->published();
        // }])->orderBy('title','asc')->get();
        // $posts=Post::with('author')->latestFirst()->published()->where('category_id',$id)->simplePaginate($this->limit);
        
        $posts=$author->post()->with('category')->latestFirst()->published()->simplePaginate($this->limit);
        return view("blog.index",compact('posts','authorName'));
    }

    public function tag(Tag $tag){
        $tagName=$tag->name;
        // $Tag=Tag::where('slug',$getTag->slug)->first();
        $posts=$tag->posts()->with('category')->latestFirst()->published()->simplePaginate($this->limit);
        return view("blog.index",compact('posts','tagName'));
    }

    
}
