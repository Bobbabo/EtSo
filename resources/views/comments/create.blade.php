<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <br>
            <br>
            <form action="/c" enctype="form-data" method="post">
                @csrf

                <div class="form-group">

                    <textarea placeholder="Type your comment" id="caption"
                        class="form-control{{ $errors->has('caption') ? ' is-invalid' : '' }}"
                        name="caption">
                    </textarea>
                
                    @if ($errors->has('caption'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('caption') }}</strong>
                        </span>
                    @endif
                    <input type="hidden" name="post_id" value="{{ $post_id }}" />
                    <button class="btn btn-primary">Post Comment</button>
                                   
                </div>            
            </form>
        </div>
        
    </div>
</div>