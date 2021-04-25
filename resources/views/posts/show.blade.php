@extends('layouts.app')

@section('content')
<div class="container">

    <div style="display: flex; align-items:center; padding: 8px">
        <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" 
            style="max-width: 40px; margin-right:16px">
        <div class="font-weight-bold">
            <a href="/profile/{{ $post->user->id }}">
                <span class="text-dark">{{ $post->user->username }}</span>
            </a>
            <a href="#" class="pl-3">Follow</a>
        </div>
    </div>


    <div class="row" style="background-color: #D6FFE9; padding-top:20px">
      
        @if($post->image != "")
            <div>
                <center><img src="/storage/{{ $post->image }}" class="w-50" style=""></center>
            </div>
        @endif 
        
        <div style="word-break: break-all; padding-top:10px; padding-left: 20px; padding-right: 20px">
            <p>
                <span class="font-weight-bold">
                <div v-pre>
                    <pre style="white-space: pre-wrap;">{{ $post->caption }}</pre>
                </div>
            </p>               
        </div>  
       
            <hr style="position: relative; width: 90%; margin-left:5%; margin-right:5%;">
        
        <div> 
            <like-button post-id="{{$post->id}}"  likes="{{$likes}}"> </like-button>                     
        </div>
        <div class="pr-5"><strong>{{ $likesCount }}</strong> likes</div>

        @include('comments.create',['post_id'=> $post->id])
        
        @include('comments.index',['comments' => $post->comments, 'post_id' => $post->id])
       
    </div>
</div>
@endsection
