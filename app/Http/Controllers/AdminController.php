<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;

class AdminController extends Controller
{
    public function index()
    {
    //$posts = Post::all();
    //$posts = Post::orderBy('title', 'asc')->get();
    $posts = DB::select('SELECT * FROM posts');
    return view('admin.index')->with('posts',$posts);
    }
}
