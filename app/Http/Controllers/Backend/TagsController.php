<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;
use App\category;
use App\Post;

class TagsController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tags= Tag::with('posts')->orderBy('name')->paginate($this->limit);
        $tagCount=Tag::count();
        return view("backend.tags.index", compact('tags','tagCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tag=new Tag();
        return view('backend.tags.create', compact('tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name'=>'required|unique:tags|max:255',
            'slug'=>'required|unique:tags|max:255',
        ]);
        Tag::create($request->all());
        return redirect('/backend/tags')->with('message', 'New Tag is created sucessfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
        $tag=Tag::findOrFail($id);
        return view('backend.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        //
        $this->validate($request, [
            'name'=>'required|max:255|unique:tags,name',
            'slug'=>'required|max:255|unique:tags,slug',
        ]);
        $category=category::findOrFail($id);
        $category->update($request->all());
        return redirect('/backend/tags')->with('message', 'Category is updated sucessfully!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
        $tag = Tag::findOrFail($id);
 
        $tag->posts()->detach();
        $tag->delete();
 
        return redirect("/backend/tags")->with("message", "The tag was deleted successfully!");
    }
}
