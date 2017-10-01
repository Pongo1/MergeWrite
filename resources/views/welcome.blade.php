<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Merge Write</title>

        <!-- Fonts -->
            {{-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/business-casual.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
        <!-- Styles -->
    </head>
    <body>

        <div class="container" >
            <div class="row" style='margin-top:230px;' id='dat-row'>

            <svg viewBox="0 0 860 250">
            <symbol id="web-coderskull">
                <text class='solid-text-light' text-anchor="middle" x="50%" y="50%">MERGE WRITE.</text>

            </symbol>

            <g class = "webcoderskull">
                <use xlink:href="#web-coderskull" class="web-coder-skull"></use>
                <use xlink:href="#web-coderskull" class="web-coder-skull"></use>
                <use xlink:href="#web-coderskull" class="web-coder-skull"></use>
                <use xlink:href="#web-coderskull" class="web-coder-skull"></use>
                <use xlink:href="#web-coderskull" class="web-coder-skull"></use>
            </g>

        </svg>

            </div>
        </div>

            <div class="container" id='pane' style='display:none;'>
                <div class="row" >
                    <div class="col-md-8 col-md-offset-2">
                             
                        <div class="home-card thumbnail home-card-color solid-two-light">
                            <center>
                                <h1 class=' solid-text-light-two merge-title' style='font-size:5em;'>MERGE WRITE</h1>
                                <hr id='underline' style='width:250px; border-width:3px;'>
                                <p style='font-size:1.7em;'><span style='color:teal'>"</span>A professional writter is one who did not quit<span style='color:teal'> "</span> <span sytle='text-style:italic'>Richard Bach</span></p>
                                <h5 style='color:black'>Merge write connects you to the different writers all over ALL campus. <br>You get to read and learn from every piece others publish. <br>
                                Sign up to join our community of writers and grow as you write.</h5>
                                @if(Auth::user())
                                     <a href='/home/{{ Auth::user()->name }}' class='btn btn-primary' style='color:white; background: teal;font-size:3em;'>Home</a>
                                @else 
                                     <a href='/register' class='btn btn-primary' style='color:white; background: teal;font-size:3em;'>Register</a>
                                    <a href='/login' class='btn btn-primary' style='color:white; background: teal;font-size:3em;'>Login</a>
                                @endif

                            </center>

                        </div>
                    </div>
                </div>
            </div>
            



    </body>
    
    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/metym.js') }}"></script>

    <style type="text/css">

    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function() {
                    // $('.merge-title').css('display','block');
                    // $('.merge-title').animate({top:'100px',left:'140px'});
                //$('.merge-title').animate({});
            }, 1000);

            $('svg').on('click',function(){
                setTimeout(function() {
                    $('svg').fadeOut(700,function(){
                        $('svg').css('display','none');
                        $('#dat-row').css('display','none');
                        $('#pane').fadeIn(400,function(){
                         $('#pane').animate({ right:'200px'});
                            //  $('body').css({'background':'url({{ asset("ALA.jpg") }}) no-repeat center center fixed',
                            //     '-webkit-background-size':'cover', 
                            //         '-moz-background-size':'cover',
                            //         '-o-background-size':'cover', 
                            //         'background-size':'cover'
                            // });
                     });



                    });

                }, 200);

            });
        });


    </script>
</html>
