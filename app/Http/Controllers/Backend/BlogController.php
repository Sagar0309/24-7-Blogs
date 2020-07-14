<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Post;

use App\Role;

class BlogController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    protected $uploadPath;

    public function __construct(){
        parent::__construct();
        $this->uploadPath=public_path('img');
    }

    public function index(Request $request)
    {
        //
        $onlyTrashed = FALSE;
        if(($status=$request->get('status')) && $status == 'trash'){
            $posts=Post::onlyTrashed()->with('category','author')->latest()->paginate($this->limit);
            $postCount=Post::onlyTrashed()->count();
            $onlyTrashed = TRUE;
        }
        elseif( $status=='published' ){
            $posts=Post::published()->with('category','author')->latest()->paginate($this->limit);
            $postCount=Post::count();
        }
        elseif( $status=='schedule' ){
            $posts=Post::Scheduled()->with('category','author')->latest()->paginate($this->limit);
            $postCount=Post::count();
        }
        elseif( $status=='own' ){
            $posts=$request->user()->post()->with('category','author')->latest()->paginate($this->limit);
            $postCount=$request->user()->post()->count();
        }
        elseif( $status=='draft' ){
            $posts=Post::draft()->with('category','author')->latest()->paginate($this->limit);
            $postCount=Post::count();
        }
        else{
            $posts=Post::with('category','author')->latest()->paginate($this->limit);
            $postCount=Post::count();
        }
        
        $statusList=$this->statusList();

        return view('backend.blog.index', compact('posts', 'postCount','onlyTrashed','statusList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $post=new Post();
        $role=Role::all();
        return view('backend.blog.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation is in PostRequest file.
        $this->validate($request, [
            'title'=>'required',
            'slug'=>'required|unique:posts',
            'body'=>'required',
            'category_id'=>'required',
            'image'=>'mimes:jpg,jpeg,bmp,png'
        ]);
        //'published_at'=>'date_format:Y:m:d H:i:s',

        $data=$this->handleRequest($request);
        $newPost=$request->user()->post()->create($data);
        $newPost->createTags($data["post_tags"]); 
        //$request->user()->post()->create($request->all(only('title','slug','body','category_id','published_at')));
        return redirect('/backend/blog')->with('message', 'Your post is created sucessfully!');     
    }

    private function handleRequest($request){
        $data=$request->all();
        if($request->hasFile('image')){
            $image=$request->file('image');
            $fileName=$image->getClientOriginalName();
            $destination=$this->uploadPath;

            $image->move($destination,$fileName);
            $data['image']=$fileName;
        }
        return $data;
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
        $post=Post::findOrFail($id);
        return view("backend.blog.edit", compact('post'));
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
            'title'=>'required',
            'slug'=>'required|unique:posts,slug, '. $id,
            'body'=>'required',
            'category_id'=>'required',
            'image'=>'mimes:jpg,jpeg,bmp,png'
        ]);
        
        $post=Post::findOrFail($id);
        $oldImage=$post->image;
        $data=$this->handleRequest($request);
        $post->update($data);
        $post->createTags($data['post_tags']);
        if($oldImage !== $post->image ){
            $this->removeImage($oldImage);
        }

        return redirect('/backend/blog')->with('message', 'Your post is updated sucessfully!');     
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
        Post::findOrFail($id)->delete();
        return redirect('/backend/blog')->with('trash-message',['Your post is put in trash!',$id]);
    }

    public function restore($id){
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->back()->with('message', 'Your post restore from trash sucessfully!');
    }

    public function forceDestroy($id){
        $post=Post::withTrashed()->findOrFail($id);
        $this->removeImage($post->image);
        $post->forceDelete();
        
        return redirect('/backend/blog?status=trash')->with('message', 'Your post deleted from trash sucessfully!');

    }

    public function removeImage($image){
        if(! empty($image)){
            $imagePath=$this->uploadPath."/".$image;
            if(file_exists($imagePath)) unlink($imagePath);
        }
    }

    public function statusList(){
        return [
            'own'=>auth()->user()->post()->count(),
            'all'=>Post::count(),
            'published'=>Post::published()->count(),
            'scheduled'=>Post::scheduled()->count(),
            'draft'=>Post::draft()->count(),
            'trash'=>Post::onlyTrashed()->count()
        ];
    }
}
