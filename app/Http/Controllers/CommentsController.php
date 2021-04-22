<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentsController extends Controller
{

    public function index()
    {
        
        return view('comments.index', compact('comments'));
    }

    public function store()
    {
        $data = request()->validate([
            'message'=> 'required',
            'post_id'=> 'required',
        ]);

        $msg = nl2br($data['message']);

        auth()->user()->comments()->create([
            'message' => $msg,
            'user_id' => auth()->user()->id,
            'post_id' => $data['post_id'],
        ]);


        return back();
    }

}
