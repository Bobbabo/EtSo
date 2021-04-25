<div class="container">
    <form action="/p" enctype="multipart/form-data" method="post">
        @csrf

        <div class="row">
            <div class="col-8 offset-2">
                <div class="form-group row">

                    <textarea placeholder="Type your caption" id="caption"
                        class="form-control{{ $errors->has('caption') ? ' is-invalid' : '' }}"
                        name="caption"
                        value="{{ old('caption') }}"
                        autocomplete="caption" autofocus>
                    </textarea>

                    @if ($errors->has('caption'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('caption') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Post Image</label>

                    <input type="file" class="form-control-file" id="image" name="image">

                    @if ($errors->has('image'))
                        <strong>{{ $errors->first('image') }}</strong>
                    @endif
                </div>

                <div>
                    What type of post is this?
                    <form>
                        <input type="radio" name="tag" value="Social" checked>Social
                        <input type="radio" name="tag" value="News">News
                    </form>
                </div>

                <div class="row pt-4">
                    <button class="btn btn-primary">Add New Post</button>
                </div>

            </div>
        </div>
    </form>
</div>
