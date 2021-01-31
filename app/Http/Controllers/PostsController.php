<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();
        //$posts = Post::orderBy('title', 'asc')->get();
        $posts = DB::select('SELECT * FROM posts');
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
        'title' => 'required',
        'body' => 'required',
        'cover_image' => 'image|nullable|max:5000'

        ]);

        if($request->hasFile('cover_image')){
            // get filename with the extention
            $fileNameWithExt = $request->file('cover_image')->getClientOrginalName();

            // get just filename 
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // get just Ext
            $extention = $request->file('cover_image')->getClientOrginalExtention();

            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extention;

            // upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }else{
            $fileNameStore='noimage.jpg';
        }        
        //create post
        $fileNameToStore = 'cover_image';
        $post=new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post-> save();

        return redirect('/posts')->with('success','Post created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Post::find($id);
        return view('posts.show')->with('posts', $posts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = Post::find($id);
        if(auth()->user()->id !== $posts->user_id){
            return redirect('/posts')->with('error','Unauthorized page.');
        }
        return view('posts.edit')->with('posts', $posts);
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
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
    
            ]);
    
            if($request->hasFile('cover_image')){
                $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
    
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
    
                $extention = $request->file('cover_image')->getClientOriginalExtension();
    
                $fileNameToStore = $fileName . '_' .time().'.'.$extention;
    
                $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
                
                $this->validate($request,[
                    'title' => 'required',
                    'body' => 'required',
                    'cover_image' => 'image|nullable|max:5000'
            
                    ]);
            }
                if($request->hasFile('cover_image')){
                    $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            
                     $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            
                     $extention = $request->file('cover_image')->getClientOriginalExtension();
            
                     $fileNameToStore = $fileName . '_' .time().'.'.$extention;
            
                    $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
                        
                }
                $post = Post::find($id);
                $post->title = $request->input('title');
                $post->body = $request->input('body');
                if($request->hasFile('cover_image')){
                    $post->cover_image = $fileNameToStore;
                }
                $post-> save();
        
                return redirect('/posts')->with('success','Post updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','Unauthorized page.');
        }

        if($post->cover_image != 'noimage.jpeg'){
            Storage::delete('public/cover/images/'.$post->cover_image);
        }

        $post ->delete();
        return redirect('/posts')->with('success','Post removed.'); 
    }
}
