<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');

        $posts = Post::whereIn('user_id', $users)->with('user')->where('post_id','=',0)->latest()->paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['image'],
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
            'post_id'  => 0
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(\App\Post $post)
    {
        return view('posts.show', compact('post'));
    }



    # Comment logic

    public function commentIndex()
    {
        
        return view('comments.index', compact('comments'));
    }

    public function commentStore()
    {
        $data = request()->validate([
            'caption'=> 'required',
            'post_id'=> 'required',
        ]);

        $cap = nl2br($data['caption']);

        auth()->user()->posts()->create([
            'caption' => $cap,
            'user_id' => auth()->user()->id,
            'image' => "auth()->user()->image",
            'post_id' => $data['post_id'],
        ]);


        return back();
    }
}
