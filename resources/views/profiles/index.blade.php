@extends('layouts.app')
@section('content')
<div class="container">
    @include('info.profile') 
    <div style="display: flex">
        <img src="{{ $user->profile->profileImage() }}" class="rounded-circle" style="width:150px">

        <div style="display: flex; justify-content:space-between;">
            <div><strong>{{ $postCount }}</strong> posts</div>

            <div style="display:flex; flex-direction:column; margin-left:10px">
                <div><strong>{{ $followersCount }}</strong> followers</div>
                <div><strong>{{ $followingCount }}</strong> following</div>
             </div>

             @can('update', $user->profile)
             <div style="margin-left:10px;">
                 <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
             </div>
              @endcan
        </div>
    </div>
    
    <div class="row">
        
        <div class="col-12 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-3">
                    <div class="d-flex align-items-center row">
                        <div class="h4">{{ $user->name }}</div>
                        <div class="h4">{{ $user->username }}</div>
                     </div>
                    <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                </div>
            </div>


            <div class="pt-4 font-weight-bold">
                {{ $user->profile->title }}
            </div>
            <div style="word-wrap: break-word">
                {{ $user->profile->description }}
            </div>
        </div>
    </div>

    <div class="scrolling-pagination">
        @foreach($posts as $post)

            <div style="display: flex; align-items:center; padding: 8px">
                <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" 
                    style="max-width: 40px; margin-right:16px">
                <div class="font-weight-bold">
                    <a href="/profile/{{ $post->user->id }}">
                        <span class="text-dark">{{ $post->user->username }}</span>
                    </a>
                </div>

                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" 
                aria-haspopup="true" aria-expanded="false" v-pre>
                    ...<span class="caret"></span>
                </a>
    
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#"
                        onclick="event.preventDefault();
                                        document.getElementById('report-form').submit();">
                        {{ __('Report') }}
                    </a>
    
                    <form id="report-form" action="#" method="GET" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

                <article class="postbox" style="margin-bottom: 20px;padding-top:20px"
                data-toggle="modal" data-target="#postModal{{$post->id}}">

                    @if($post->image != "")
                    <div>
                        <center><img src="/storage/{{ $post->image }}" class="w-50" style=""></center>
                    </div>
                    @endif 
                    {{$post->tag}}
                    
                    <div style="word-break: break-all; padding-top:10px; padding-bottom:10px; 
                        padding-left: 20px; padding-right: 20px">
        
                        <p>
                            <span class="font-weight-bold">
                            <div v-pre>
                                <pre style="white-space: pre-wrap;">{{ $post->caption }}</pre>
                            </div>
                        </p>               
                    </div>  
                </article>
            <div class="modal fade" id="postModal{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="postModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
       
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        @include('posts.postModal', ['likes' => (auth()->user()) ? auth()->user()->likes->contains($post) : false, 'likesCount'=> $post->likes->count()])
                    </div>
                  </div>
                </div>
              </div>
        @endforeach

            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{ $posts->links('pagination::bootstrap-4') }}
                </div>
            </div> 

    </div>

</div>


{{-- infinite scroll pagination 
Credit to https://devdojo.com/bobbyiliev/how-to-add-a-simple-infinite-scroll-pagination-to-laravel --}}
<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>

<script type="application/javascript">
    $('ul.pagination').hide();
    $(function() {
        $('.scrolling-pagination').jscroll({
            autoTrigger: true,
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.scrolling-pagination',
            callback: function() {
                $('ul.pagination').remove();
            }
        });
    });

</script>
@endsection
