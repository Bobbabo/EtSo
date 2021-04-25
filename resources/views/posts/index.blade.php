@extends('layouts.app')
@section('content')

<div class="container">
    <center>
        <div style="background-color: #B5FFC0; margin-bottom:20px; width: 30%; padding-top: 10px; 
        padding-bottom:10px;font-weight: bold; color:#4F514F;
        border-style:solid; border-color:#D6FFE9; border-width:10px" data-toggle="modal" data-target="#exampleModal"> 
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

                <follow-button user-id="{{ $post->user_id }}" 
                    follows="{{ (auth()->user()) ? auth()->user()->following->contains($post->user->id) : false }}">
                </follow-button>

                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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



            
            <a href="/p/{{ $post->id }}">
                <article class="postbox" style="margin-bottom: 20px;padding-top:20px">
                    <a href="/p/{{ $post->id }}"></a>

                    <div style="display: flex; justify-content:space-between" >
                        {{$post->tag}}
                    
                    </div>
                    


                    @if($post->image != "")
                    <div>
                        <center><img src="/storage/{{ $post->image }}" class="w-50" style=""></center>
                    </div>
                    @endif 
                    <a href="/p/{{ $post->id }}"> </a>
                    <div style="word-break: break-all; padding-top:10px; padding-left: 20px; padding-right: 20px">
                        <p>
                            <span class="font-weight-bold">
                            <div v-pre>
                                <pre style="white-space: pre-wrap;">{{ $post->caption }}</pre>
                            </div>
                        </p>               
                    </div>  

                    
                </article>
            </a>

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

    $(".postbox").click(function() {
        window.location = $(this).find("a").attr("href"); 
        return false;
    });

</script>

@endsection
