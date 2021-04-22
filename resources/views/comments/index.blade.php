<div class="container">
    <div class="scrolling-comments" style="height: 200px; overflow: visible; width: 100%;">
        @foreach($comments as $comment)
            <div class="row pt-2 pb-4 postbox">
                <div class="col" style="word-break: break-all;">
                    <div>
                        <p>
                            <span class="font-weight-bold">
                                <a href="/profile/{{ $comment->user->id }}">
                                    <span class="text-dark">{{ $comment->user->username }}</span>
                                </a>
                            </span>
                        </p>
                        {!! ($comment->caption) !!}
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>


