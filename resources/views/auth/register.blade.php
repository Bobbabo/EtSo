@extends('layouts.app')

@section('content')
<div class="container">

    <h2>This application is only a prototype!</h2>
    <h5>You can create an account and explore the site by following other people,
        creating posts, and various other social media features similar to Twitter and Facebook. <br>
        But please be careful about what information you post, since this application cannot
        protect sensitive data!
    </h5>

    <center>
        <div class="infoButton" data-toggle="modal" data-target="#infoModal">
            i
        </div>
        <h6><strong>Click the information button above to read more!</strong></h6>
    </center>


    <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="infoModalLabel">About EtSo</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <h5>EtSo is an experimental site.<br>
                The purpose of EtSo is to evaluate whether an ethical social media platform could be possible in the future.
                <br><br>
                EtSo consist of various common social media features. Users can post statuses, comment on other people’s 
                statuses, follow each other and even chat!
                As it is right now, many of those features have limited functionality. That is why EtSo should only be seen as a 
                prototype, representing the hopes of a future, more thorough, social media platform that is ethical.
                <br><br>
                In regards of ethicality, EtSo is very proud and strong!
                Here are some examples of ethical design choices made to improve the flow of information sharing and the 
                mental health of the users:</h5>
                <br>
                <ul>
                    <li>
                    <h5>Informational posts are rated by reliability</h5>
                    In order to combat fake news, any post containing the News tag will have the like button 
                    replaced with a reliability button.
                    </li>
                    <br>
                    <li>
                    <h5>Likes are hidden</h5>
                    Likes are only shown after the user has clicked on a post. This is in order to avoid social bias 
                    affecting which posts become popular.
                    </li>
                    <br>
                    <li>
                    <h5>The feed is chronologically sorted </h5>
                    Many sites use various techniques to keep the user more engaged than what is good for the user. 
                    It is possible to make an ethical algorithm that makes it easy for the user to see most relevant posts 
                    first while avoiding echo chambers, but since this is just a prototype, viewing posts in chronological 
                    order will have to do.
                    </li>
                </ul>
                <h5>
                    But despite all of this, it is also important to point out that, as of this moment, 
                    EtSo is vulnerable to bot attacks and security breaches that could compromise the data kept 
                    on the platform. Lucky, EtSo does not track behavioral data, so the user is completely in control 
                    of what data is put up on the site, so just use common sense and you will be fine!
                </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Understood!</button>
            </div>
          </div>
        </div>
      </div>



    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autocomplete="email">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" autocomplete="username">

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" autocomplete="new-password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
