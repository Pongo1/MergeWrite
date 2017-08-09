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
        <!-- NAV BAR -->

        <nav class="navbar fontlize navbar-default navbar-inverse navbar-fixed-top" style="border-radius:0px;box-shadow:0 4px 10px rgba(0,0,0,0.7); background-color:maroon; color:white">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class='navbar-header'>
            	<a class="navbar-brand kiddie" href="/" style='color:white; text-transform: capitalize;font-family: "Helvetica Neue", Helvetica, Arial, sans-serif'>Merge Write</a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">

    			<ul class="nav navbar-nav navbar-right">
                    @if(Route::has('login'))
                        @if(Auth::check())
                            <li class='kiddie' ><a class='fontlize' href="{{ route('home',Session::get('username')) }}" style='color:white'>Home</a></li>
                            <li class='kiddie' ><a style='color:white' href="//">Feed</a></li>

                        @else
            				<li class='kiddie angel' ><a style='color:white' href="{{ url('/login') }}">Login</a></li>

            				<li class='kiddie angel' ><a style='color:white' href="{{ url('/register') }}">join</a></li>


                        @endif
                    @endif
                    <li ><a type='button' data-toggle='modal'style='color:white'  data-target='#about' class='kiddie'>About</a></li>
                    <li ><a href="#"> </a></li>

    			</ul>
            </div>
		</nav>

        <div style='margin-top:60px;'></div>
        <div class='container'>
            <div class='row'>
                <div class='box'>
                    <div class='col-lg-12'>

                        <img src='pen-bg.jpeg' class='img-responsive img-full' size='500x500'>
                        <center>
                            <h2 class="brand-before">
                                <small>Welcome to</small>
                            </h2>

                            <h1 class="brand-name dark-knight">Merge Write</h1>
                            <hr class="tagline-divider">
                            <h2>
                                <small style='font-style:italic;'>"No writing is wasted"
                                </small>
                            </h2>

                        </center>
                    </div>
                </div>
            </div>
       </div>

       <div class='container'>
           <div class="row">
               <div class="box">
                   <div class="col-lg-12">

                       <h2 class="intro-text text-center">AIM OF
                           <strong>Merge Write</strong>
                       </h2>
                       <p class='text text-muted' style='font-style:italic; text-align:center;'>"A professional writer is an amateur who did not quit"
                           <span><small class='label label-danger'><b>Richard Bach</b></small></span></p>

                       <img class="img-responsive img-border img-left" src="img/intro-pic.jpg" alt="">

                       <p> Writing is an art, and an art only comes in its full suit if it is fine tuned over a long period and critical looks taken at unconventional angles. That is our whole essence. Writer's merge seeks to connect Africans who love to express themselves throuh words and expressions.  Mergers include what kinds of expression and various tools in english language they have used in their pieces to help and develope the readers. Merge Write is totally level-blind. It is not limited to only the professionals and the 21st century shakespares, anyone can join the community. We believe in growth, step by step, through reading written pieces from others, we believe  everyone will be able to develope pieces of their own and climb up the ladder.

                       </p>
                   </div>
               </div>
           </div>

           <div class="row">
               <div class="box">
                   <div class="col-lg-12">

                       <h2 class="intro-text text-center">
                           <strong class='burn'>HOT PIECES</strong><br>
                           <small>Catch a glimpse of some of our hot pieces</small>
                       </h2>


                       <div class=' text-center'>
                           <img src='imgs/somebro.png' class='avatar'>
                       </div>
                       <div class='thumbnail' style='padding:50px 15px;'>
                           <h2 class="intro-text text-center">
                               <strong class='fire'>SKEULTZI </strong><small class='label label-default'style='background-color:deeppink; font-size:10px;'>Siphiwe</small>
                           </h2>

                           <p class='clearfix'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc placerat diam quis nisl vestibulum dignissim. In hac habitasse platea dictumst. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.<br>

                           <small class='pull-right text text-muted fontlize'><span class='glyphicon glyphicon-thumbs-up'></span> 3k</small><small style='opacity:0;' class='pull-right'>oo </small>
                           <small class='pull-right text text-muted fontlize'><span class='glyphicon glyphicon-money'></span> 3k</small><small style='opacity:0;' class='pull-right'>oo </small>
                            <small class='pull-right text text-muted fontlize'><span class='glyphicon glyphicon-comment'></span> 520</small>
                        </p>
                       </div>
                       <div class=' text-center'>
                           <img src='imgs/avatar-black.png' class='avatar'>
                       </div>
                       <div class='thumbnail' style='padding:50px 15px;'>

                           <h2 class="intro-text text-center">
                               <strong class='fire'>DORIS </strong><small class='label label-default'style='background-color:orange; font-size:10px;'>Shakespare</small>
                           </h2>

                           <p class='clearfix'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc placerat diam quis nisl vestibulum dignissim. In hac habitasse platea dictumst. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas."But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime .
                               <br>

                           <small class='pull-right text text-muted fontlize'><span class='glyphicon glyphicon-thumbs-up'></span> 12k</small><small style='opacity:0;' class='pull-right'>oo </small>
                           <small class='pull-right text text-muted fontlize'><i class='fa fa-money'></i> 1k</small><small style='opacity:0;' class='pull-right'>oo </small>
                            <small class='pull-right text text-muted fontlize'><span class='glyphicon glyphicon-comment'></span> 620</small>
                        </p>
                       </div>
                       <div class=' text-center'>
                           <img src='imgs/chick-samurai-avatar.png' class='avatar'>
                       </div>
                       <div class='thumbnail' style='padding:50px 15px;'>
                           <h2 class="intro-text text-center">
                               <strong class='fire'>SAMUEL </strong><small class='label label-default'style='background-color:deeppink; font-size:10px;'>ACHEBE</small>
                           </h2>

                           <p class='clearfix'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc placerat diam quis nisl vestibulum dignissim. In hac habitasse platea dictumst. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.<br>

                           <small class='pull-right text text-muted fontlize'><span class='glyphicon glyphicon-thumbs-up'></span> 3k</small><small style='opacity:0;' class='pull-right'>oo </small>
                           <small class='pull-right text text-muted fontlize'><span class='glyphicon glyphicon-money'></span> 3k</small><small style='opacity:0;' class='pull-right'>oo </small>
                            <small class='pull-right text text-muted fontlize'><span class='glyphicon glyphicon-comment'></span> 520</small>
                        </p>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>



   <!-- END OF Merge Write COVER -->
   <div class='container'>
       <div class='row'>
            <div class='box'>
                <div class='col-lg-12'>
                    <h2 class="intro-text text-center">
                        <strong>HOW THINGS WORK</strong><br>
                        <small>Parts of every piece and their functions</small>
                    </h2>
                    <p>This is a break down of the parts of every piece that any writer will publish. Every writer is called a merger, and anything any writer publishes is called a piece. Whether it be a poem, a story, prose, or a whole book. Around every piece, there will be numerous wee buttons that will help your disect that piece. Some will help you view that particular writing in its skeleton form, another will help you make a comment, and others to like, and rate.</p>

                </div>
            </div>
            <div class='col-lg-4 slicer-left slicer'>
                <div class='row'>
                    <div class='box rec clearfix'>
                        <div class='pin solid pull-right'></div>
                        <div class='pin solid'></div>
                        <h2 class="intro-text text-center">
                            <strong>SKELETON VIEW</strong><br>
                            <small>This function will allow you to view the whole piece with all its literary and language tools as placed by the owner of that the piece. So it will be shown clearly where a <span class='label label-default'>simile</span> was used, where a particular sentence has a <span class='label label-default'>metaphor</span> where a <span class='label label-default'>noun</span>, <span class='label label-default'>adjective</span>, or <span class='label label-default'>adverb</span> appears.</small>
                        </h2>
                    </div>
                </div>
            </div>
            <div class='col-lg-3 slicer-left slicer'>
                <div class='row'>
                    <div class='box rec'>
                        <div class='pin solid pull-right'></div>
                        <div class='pin solid'></div>
                        <h2 class="intro-text text-center">
                            <strong>RATING AND COMMENTS</strong><br>
                            <small>Every piece will be available to all writers unless it is not published. Any one can rate any piece. Pieces are rated in <span class='label label-default'>merge coins.</span> Only five coins are alloted to every piece, but you can comment as many times as you want.</small>
                        </h2>
                    </div>
                </div>
            </div>
            <div class='col-lg-4 slicer-left'>
                <div class='row'>

                    <div class='box rec'>
                        <div class='pin solid pull-right'></div>
                        <div class='pin solid'></div>

                        <h2 class="intro-text text-center">
                            <strong>BADGES OR RANKS</strong><br>
                            <small>Every writer will have a badge. This will tell the weight of a Merger's comment and how it will be received. All this is to say, that even though a writer with a rank or badge of <span class='label label-default'>Peeker</span> may provide valuable comment on your piece, another who has rank <span class='label label-default'>siphiwe</span>'s comment will be treated differently --with more respect.<br> It is therefore important to move up the ranks. <br>How is that done? Sign up to meet pongo, he will take you through everything you need to know.<a href='#' class='btn btn-default'>Join</a></small>
                        </h2>
                    </div>
                </div>
            </div>
       </div>
    </div>
       <!-- /.container -->

   <footer class='' style='background-color:maroon;'>
       <div class="container">
           <div class="row">
               <div class="col-lg-12 text-center">
                   <p>Copyright &copy; Merge Write 2017</p>
               </div>
           </div>
       </div>
   </footer>

        <div class="modal fade" id='about'>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'></span>&times;<span class="sr-only"></span></button>
                            <h4 class='modal-title solid-text-light' style='color:black;'><b>About </b></h4>
                        </div>
                        <div class='modal-body'>
                            <center>
                                <h1 class="solid-text" style="color:black"><span class='glyphicon glyphicon-edit'></span><b> @meTym</b></h1>
                            </center>
                            <p style="color:black;">Have you ever had any idea that you were a 100% sure was worth a million dollars? Do you still remember the pain you felt when you were ready to write it down but could not remember what it was exactly?<br> How dark is your mind? Is it full, do you need something to empty it into? This application <b><span class='solid-text-light-two'>@</span><span style='color:orange;' class="solid-text-light-two">meTym</span></b> is for you.<br>This wonderful platform was created by <strong><span class=" solid-text-light-two" style='color:black;'>Frimpong Opoku agyemang</span></strong>, a young ghanaian teenager who is all for and totally in love with technology. This is just one of his classics. You can follow him on facebook, instagram and contact him via whatsapp with 0506656035 /  07036987822 and via email through mrfimpong@gmail.com   </p>
                        </div>
                        <div class='modal-footer'>
                            <button class='btn btn-danger' type='button' data-dismiss='modal'>Close</button>
                        </div>
                    </div>
                </div>
            </div>
    </body>
    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/metym.js') }}"></script>
</html>
