@extends('layouts.app')
@section('content')

<div class="container">

    @include('info.feed')

    <center>
        <div class ="create-button" data-toggle="modal" data-target="#exampleModal"> 
            CREATE A POST 
        </div>
    </center>
    
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create a new post</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                @include('posts.create')
            </div>
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
            <div class="postbox" style="text-align: center">
                <br><br><br>
                <h5>It is not healthy to be stuck in an infinite feed!
                    <br>Consider taking a break!</h5>
               <br><br><br>
            </div>

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
