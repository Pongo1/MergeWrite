<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

        <title>meTym-unavailable</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }
            .solid-type-two{
                   box-shadow:6px 9px 0px rgba(0,0,0,0.9);
               }
               .solid{
                   box-shadow:0 6px 8px rgba(0,0,0,0.8);

               }
               .solid-two{
                   box-shadow:0px 3px 4px rgba(0,0,0,0.5);

               }
               .solid-two-light{
                   box-shadow:0px 3px 3px rgba(0,0,0,0.3);

               }
               .solid-text{
                   text-shadow: 0px 4px 8px rgba(0,0,0,0.8);
               }
               .solid-text-light{
                   text-shadow: 0px 3px 6px rgba(0,0,0,0.6);

               }
               .solid-text-light-two{
                   text-shadow: 0px 2px 4px rgba(0,0,0,0.4);

               }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">


            <div class="content alert alert-danger solid-two-light">
                <div class="title m-b-md solid-text">
                    Page unavailable.
                </div>

                <div class="links">
                    <p class='solid-text-light-two'> The page you are looking is not available.</p>
                    <div class="btn btn-warning btn-xs pull-right solid-two-light solid-text-light-two"><a href='/'>Back</a></div>
                </div>
            </div>
        </div>
    </body>
</html>
