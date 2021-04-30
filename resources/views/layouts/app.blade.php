<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>EtSo</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="overflow-x:hidden">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="position: fixed; z-index: 999; background: #D6FFE9; width: 100%;">
            <div id="navbar" class="container">
                
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">                  
                    <div class="pl-3">EtSo</div>
                </a>

                <form action="{{ route('search') }}" method="GET">
                    <input type="text" name="search" required style="border: 0"/>
                    <button type="submit" style="border-radius: 12px; background-color: #B5FFC1; color: black;
                    border: 0px solid white">Search</button>
                </form>

                 <!-- For small screen size -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        
                            <a href="/profile/{{ Auth::user()->id }}" class="navbar-brand d-flex align-items-center">
                                <img src="{{Auth::user()->profile->profileImage()}}" style="height: 30px;" class="rounded-circle w-20">
                            </a>    

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            
                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- sidebar nav -->

       <div style="display: flex; justify-content: space-between;">

             <!-- left sidebar -->
            <div class=".col-md-3" style="width: 25%; ">
                @guest

                @else
                <div  id="sidebar" style="z-index: 998; height: 100%;">
                    <nav id="sidebar-nav"  style="position: fixed; background: #B5FFC1; height: 100%; width: 25%;  
                    padding-top: 70px; ">
                        <div style="display: flex; flex-direction:column; justify-content:center; margin-top:50px">
                            <a href="{{ url('/') }}" style="text-decoration: none;">
                                <div class="button-button">Feed</div>
                            </a>
                            <a href="/profile/{{ Auth::user()->id }}" style="text-decoration: none;">
                                <div class="button-button">Your Profile</div>
                            </a>
                            <a href="{{ url('/chat') }}" style="text-decoration: none;">
                                <div class="button-button">Chat</div>
                            </a>
                            <a href="{{ url('/values') }}" style="text-decoration: none;">
                                <div class="button-button">Our Values</div>
                            </a>
                        </div>
                    </nav>
                </div>
                @endguest
            </div>

            <!-- page content -->
            <div class=".col-md-8" style="padding-top: 70px; width: 40%;">
                <main class="py-4">
                    @yield('content')
                </main>
            </div>


            <!-- right sidebar -->
            <div class=".col-md-3" style="width: 25%; " >
                @guest
                @else
                <div  id="sidebar"  style="z-index: 998; height:100%;">
                    <nav id="sidebar-nav" style="position: fixed;  background: #B5FFC1; height: 100%; width: 25%;  padding-top: 70px;">
                        <div style="display: flex; flex-direction:column; justify-content:center; margin-top:50px">
                            @include('info.sidebar')
                        </div>
                    </nav>
                </div>
                @endguest
            </div>
       </div>       
    </div>

    <div class="modal fade" id="infoSidebarModal" tabindex="-1" role="dialog" aria-labelledby="infoSidebarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="infoSidebarModalLabel">About the sidebar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <h5>
                  This is the sidebar
              </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Understood!</button>
            </div>
          </div>
        </div>
      </div>
</body>
</html>
