@extends('layouts.app')

@section('content')
    <div style='margin-top:60px'></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-offset-2 col-md-8">
                <div class="thumbnail thumbnail-tune solid-two" style='border:solid 3px maroon;'>
                    <img src='{{asset($user->profile_picture)}}' class='solid-two profile-avatar'>
                    <center>
                        <h3 class='dark-knight'>{{$user->name}}</h3>
                        <h4 class='dark-knight'>{{$user->email}}</h4>
                        <small class='{{'label label-default dark-knight solid-rank '.$user->rank->rank}}'>{{$user->rank->rank}}</small><br>
                        <small class='dark-knight'>Has created {{count($user->notes)}} pieces</small><br>
                        <small class='dark-knight'>Has made {{count($user->publishes)}} publish{{count($user->publishes) ==1 ? '' : 'es'}}</small><br>
                        <small class='dark-knight'>Worth {{$user->bank->coins}} coins</small><br>
                        @if($user->id == Auth::user()->id)
                            <button style='width:100px;' data-toggled='true' type="button" id='profile-button' class='btn btn-default solid-rank dark-knight' name="button">Edit <span class='caret'></span></button>
                        @endif
                    </center>
                </div>
                <div class="thumbnail-tune thumbnail" id='profile-edit' style='display:none'>
                    <div class="cover-piece-text clearfix">
                        <h4 class='dark-knight'>Change picture</h4>
                        @if(Session::has('Notice'))
                            <small class='text text-danger text-center'>{{Session::get('Notice')}}</small><br>
                        @endif
                        <small class='dark-knight' >Upload a picture of your own of choose an avatar</small><br>
                        <img src='{{asset("imgs/chick-samurai-avatar.png")}}' class='picture1 thumbnail pull-left cover-piece-text' style='width:100px;height:100px;cursor:pointer; border-color:black; border-radius:0;'>
                        <button style='opacity:0' class='pull-left'>space</button>
                        <img src='{{asset("imgs/avatar-female.png")}}' class='picture2 thumbnail pull-left cover-piece-text' style='width:100px;height:100px;cursor:pointer; border-color:black; border-radius:0;'>
                        <button style='opacity:0' class='pull-left'>space</button>
                        <img src='{{asset("imgs/ninja-avatar-male.jpeg")}}' class='thumbnail picture3 cover-piece-text' style='width:100px;height:100px;cursor:pointer; border-color:black; border-radius:0;'><br>

                        <form class="" action="{{route('picture.change')}}" method="post" enctype='multipart/form-data'>
                            {{csrf_field()}}
                            <input type="file" class='dark-knight' name="user_pic" >
                            <input type="hidden" name="picture_path" id='picture_path' value="">
                            <button style='' class='btn btn-primary pull-right solid-rank'>Change</button>
                        </form>

                    </div>

                    <div class="cover-piece-text clearfix">
                        <form class="" action="index.html" method="post">
                            <div class="form-group clearfix">
                                <label for="password" class='dark-knight'>Password</label>
                                <input type="password" class='form-control' style='width:80%' name="password" value="">
                                <label for="password-confirmation" class='dark-knight'>Confirm Password</label>
                                <input type="password" class='form-control' style='width:80%' name="password_confirmation" value="">

                            </div>
                            <button style='' class='btn btn-primary pull-right solid-rank'>Change</button>
                        </form>

                    </div>


                </div>

            </div>

        </div>

    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/profile.js')}}"></script>
    <script src="{{ asset('js/universal.js') }}"></script>

@endsection
