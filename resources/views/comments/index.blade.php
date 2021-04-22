<div class="container">
    <div class="scrolling-comments" style="height: 200px; overflow: scroll; width: 100%;">
        @foreach($comments as $comment)
            <div class="row pt-2 pb-4">
                <div class="col">
                    <div>
                        <p>
                        <span class="font-weight-bold">
                            <a href="/profile/{{ $comment->user->id }}">
                                <span class="text-dark">{{ $comment->user->username }}</span>
                            </a>
                        </span>
                        </p>
                        {!! ($comment->message) !!}
                    </div>
                </div>
            </div>
        @endforeach

        {{--    <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{ $comments->links('pagination::bootstrap-4') }}
                </div>
            </div> --}}

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
