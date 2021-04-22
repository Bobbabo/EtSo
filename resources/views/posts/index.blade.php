@extends('layouts.app')
@section('content')

<div class="container">
    <div class="scrolling-pagination">
        @foreach($posts as $post)
            <a href="/p/{{ $post->id }}">
                <article class="postbox" style="margin-bottom: 20px;padding-top:20px">
                    <div class="row">
                        <div class="col-6 offset-3">
                            <a href="/p/{{ $post->id }}">
                                <img src="/storage/{{ $post->image }}" class="w-100">
                            </a>
                        </div>
                    </div>
                    <div class="row pt-2 pb-4">
                        <div class="col-6 offset-3">
                            <div style="overflow: hidden">
                                <p>
                                <span class="font-weight-bold">
                                    <a href="/profile/{{ $post->user->id }}">
                                        <span class="text-dark">{{ $post->user->username }}</span>
                                    </a>
                                </span> {{ $post->caption }}
                                </p>
                            </div>
                        </div>
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
