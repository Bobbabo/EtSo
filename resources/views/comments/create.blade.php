<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <br>
            <br>
            <form action="/c" enctype="form-data" method="post">
                @csrf

                <div class="form-group">

                    <textarea placeholder="Type your comment" id="message"
                        class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}"
                        name="message">
                    </textarea>
                
                    @if ($errors->has('message'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('message') }}</strong>
                        </span>
                    @endif
                                    
                    <input type="hidden" name="post_id" value="{{ $post_id }}" />
                    <button class="btn btn-primary">Post Comment</button>
                                   
                </div>            
            </form>
        </div>
        
    </div>
</div>