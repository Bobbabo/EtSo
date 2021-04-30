<div class="container">
    <div class="scrolling-comments" style="height: 200px; overflow: visible; width: 100%;">
        @foreach($comments as $comment)
            <div class="row pt-2 pb-4 postbox">

                @if (Auth::user()->id==$comment->user->id)
                <a href="/p/remove/{{ $comment->id }}">
                    <span class="text-dark">Remove</span>
                </a>
                @endif

                <div class="col" style="word-break: break-all;">
                    <div>
                        <p>
                            <span class="font-weight-bold">
                                <a href="/profile/{{ $comment->user->id }}">
                                    <span class="text-dark">{{ $comment->user->username }}</span>
                                </a>
                            </span>
                        </p>
                        <div v-pre>
                            <pre style="white-space: pre-wrap;">{{ $comment->caption }}</pre>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>


