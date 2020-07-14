<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\category;

use App\Post;

class CategoriesController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories= category::with('posts')->orderBy('title')->paginate($this->limit);
        $categoriesCount=category::count();
        return view("backend.categories.index", compact('categories','categoriesCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category=new category();
        return view('backend.categories.create', compact('category'));
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
            'title'=>'required|unique:categories|max:255',
            'slug'=>'required|unique:categories|max:255',
        ]);
        category::create($request->all());
        return redirect('/backend/categories')->with('message', 'New category is created sucessfully!');     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category=category::findOrFail($id);
        return view('backend.categories.edit', compact('category'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'title'=>'required|max:255|unique:categories,title,'.$id,
            'slug'=>'required|max:255|unique:categories,slug,'.$id,
        ]);
        $category=category::findOrFail($id);
        $category->update($request->all());
        return redirect('/backend/categories')->with('message', 'Category is updated sucessfully!');     

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if($id != config('cms.default_category_id')){
            $category=category::findOrFail($id);
            Post::withTrashed()->where('category_id',$id)->update(['category_id'=>config('cms.default_category_id')]);
            $category->delete();
            return redirect('/backend/categories')->with('message', 'Category is Deleted sucessfully!');
        }else{
            return redirect('/backend/categories')->with('error-message', 'Category is not Deleted !');
        }

        
    }
}
