<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Bossu</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/merge.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3" id ='login-form'>

                        @if(Session::has('bossu-authenticated'))
                            <div class="thumbnail thumbnail-tune clearfix solid-two" style='margin-top:140px;padding-bottom:60px;border:solid 3px white;'>
                                <h2 class='text-center dark-knight'>Search</h2>
                                <center>
                                    <small class='text text-muted'>You can look for any user here!</small><br>
                                    @if(Session::has('success'))
                                        <small class='text text-success'>{{Session::get('success')}}</small>
                                    @endif

                                </center>
                                <button type="button" name="search" id='search-button' class='btn btn-success pull-right solid-rank solid-text-light-two'>
                                    <span class='glyphicon glyphicon-search'></span>
                                </button>
                                <input type="text" name="text" value="" id='search-text' placeholder="type a username" class='form-control' style='width:90%;border:solid 2px green;'>
                            </div>
                            <div class="thumbnail thumbnail-tune solid-two" id='results-box' style='border:solid 3px white; min-height:250px; max-height:600px; overflow-y:scroll;'>
                                <h4 class='dark-knight text-center'><span class='glyphicon glyphicon-search'></span> Search results</h4>
                            </div>
                        @else
                            <div class="thumbnail thumbnail-tune solid clearfix" style='margin-top:140px;padding-bottom:60px;border:solid 3px white;'>
                                <h3 class='dark-knight text-center solid-text-light-two'>Bossu login</h3>
                                <center>
                                    <small>This is meant for the creators of merge write. If you find yourself here by any means and you know you are not a bossu, retract your steps.</small>
                                </center>
                                <br>
                                <button type="button" id="go" class='btn btn-success pull-right solid-rank solid-text-light-two'><span id='go-span' class=''></span>Go</button>
                                <input type="password" autofocus='true' name='bossuPassword'  id='bossu-token' value="" placeholder="Enter bossu token" class='form-control solid-rank' style='width:90%;background:black;border:solid 3px crimson; color:white'>
                                <small class='text text-danger'>{{Session::has('bossu-error') ? Session::get('bossu-error') :''}}</small>
                                <br>
                            </div>
                    @endif
                </div>
            </div>
        </div>
        <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript" src='{{asset('js/bossu.js')}}'> </script>
    </body>
</html>
