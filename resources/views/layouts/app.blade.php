<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/merge.css') }}" rel="stylesheet">
</head>
<body>
    <style> 
        @if(!Auth::guest())
            #app{
            transition: margin-left 0.5s;
            margin-left:250px;
            }
        @endif
    </style>
    <div id="app">
        <nav class="navbar navbar-inverse  thenavbar  " style='margin-bottom:0'>
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" data-toggled='true' id='side-bar-toggler' style="color:white"><i class='glyphicon glyphicon-menu-hamburger' ></i></a>
                    <a class="navbar-brand solid-text-light-two" href="{{ url('/') }}" style="color:white" id="meTymNav">Merge Write</a>
                    
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a class="solid-text-light" style="color:white;" href="{{ route('login') }}">Login</a></li>
                            <li><a class="solid-text-light" style="color:white;" href="{{ route('register') }}">Register</a></li>
                        @else
                            <li ><a href='#' data-target='#shop-modal' data-toggle='modal' type='button' style='color:white'><span class='glyphicon glyphicon-shopping-cart'></span> Shop</a></li>
                            <li ><a href='{{route('pieces.latest')}}' style='color:white'><span class='glyphicon glyphicon-globe solid-text-light-two solid-text-light-two'></span> Published pieces</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle solid-text-light-two"  data-toggle="dropdown" style="color:white" role="button" aria-expanded="false">
                                    <strong><span class="glyphicon glyphicon-user" style="color:lime"></span> {{ Auth::user()->name }}</strong> <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu solid-text-light-two" role="menu">
                                    <li>
                                        <a href='{{ route('home',Auth::user()->name) }}'><span class='glyphicon glyphicon-home text text-primary' ></span> Home
                                        </a>
                                    </li>

                                    <li><a href='{{ route('make.note') }}'><span class='glyphicon glyphicon-comment text text-success' ></span> New Piece</a></li>
                                    <li><a style='cursor:pointer' type='button' data-toggle='modal' data-target='#book-Name'><span class="glyphicon glyphicon-book" style='color:orange'></span> Create book</a></li>

                                    <li><a style='cursor:pointer'><span class="glyphicon glyphicon-cog" style='color:orange'></span> Settings</a></li>
                                    <li><a style='cursor:pointer' href='{{route('profile.show',Auth::user()->name)}}'><span class="glyphicon glyphicon-user" style='color:orange'></span> Your profile</a></li>

                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                           <span class='glyphicon glyphicon-log-out' style='color:red;'></span> Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
        @if(!Auth::guest())
        <div class='left-nav'>
             <div style='margin:0; background: #111;padding-top:10px; '> 
                <center>
                    <img id='user-profile-pic' src={{asset(Auth::user()->profile_picture)}}><br>
                    <div class='dropdown'>
                        <small data-toggle='dropdown'style='text-transform: uppercase; color:white'>{{  Auth::user()->name  }}
                            <a id='name-arrow' class='dropdown-toggle' data-opened='false' style='cursor:pointer'>
                                <span class='glyphicon glyphicon-triangle-bottom' style='color:white;margin:1px;'></span>
                            </a>
                        </small>
                            <ul class='dropdown-menu' role="menu" id='profile-options' style='left:30px;border:solid 2px teal'>
                                <li><a href=""><span class='glyphicon glyphicon-user'></span> Profile</a></li>
                            </ul>
                        <span class=' {{ 'label label-default solid-rank '.Auth::user()->rank->rank}} '>{{Auth::user()->rank->rank}}</span>
                    </div>
                    <hr style='border-color:gray'>
                </center>
            </div>
            <ul class='side-bar-options clearfix' >
                <li class='clearfix'>
                    <a href="admin"><i class="glyphicon glyphicon-plus pull-left" style='margin-top:4px;'></i> New Piece</a>
                </li>                    
                <li class='clearfix'>
                    <a href="orders"><i class="glyphicon glyphicon-book pull-left" style='margin-top:4px;'></i> Create Book</a>
                </li>
                <li class='clearfix'>
                    <a href="admin"><i class="glyphicon glyphicon-cog pull-left" style='margin-top:4px;'></i> Settings</a>
                </li>                    
                <li class='clearfix'>
                    <a href="orders"><i class="glyphicon glyphicon-pushpin pull-left" style='margin-top:4px;'></i> Grabs</a>
                </li>
                <li class='clearfix'>
                    <a href="orders"><i class="glyphicon glyphicon-shopping-cart pull-left" style='margin-top:4px;'></i> Rank Shop</a>
                </li>
            </ul>
        </div>

        @endif
    </div>


    <!-- MAKE NEW BOOK MODAL -->
    @if(!Auth::guest())
        <div class='modal fade' id='book-Name'>
            <div class='modal-dialog modal-md'>
                <div class='modal-content'>
                  <div class='modal-header'>
                      <h4 class='solid-text-light-two' style='color:black'><span style='color:orange' class=' glyphicon glyphicon-book'></span> <b>Make a book</b><button data-dismiss='modal' aria-hidden="true" class='close pull-right'>x</button></h4>
                  </div>
                  <form method='get' action='{{ route('book.create')}}' style='color:black'>
                      {{csrf_field()}}
                        <div class='modal-body'>
                          <small>You are about to start a new book. What would you like the book to be called <b>{{ Auth::user()->name}}</b>?</small>
                          <br>
                          <br>
                              <div class='form-group'>
                                  <input class='form-control' name='book_name' placeholder="Book title" data-required='Please provide the title of your book' required>
                                  @if(Auth::user())
                                      <input type='hidden' value='{{ Auth::user()->id }}' name='user_id'>
                                @endif
                              </div>
                        </div>
                          <div class='modal-footer'>
                              <div class='form-group'>
                                  <button class='btn btn-danger solid-two-light btn-sm solid-text-light-two'  data-dismiss='modal'>Cancel</button>
                                  <input type='submit' name='send_book_title' style='background:orange; color:white' value='create' class='btn btn-warning solid-text-light-two btn-sm solid-two-light'>
                              </div>
                         </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    @endif
    <footer class='school-color' >
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; Merge Write 2017</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    @yield('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
</body>


</html>
