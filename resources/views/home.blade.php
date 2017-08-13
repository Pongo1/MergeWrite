@extends('layouts.app')

@section('content')
<div style="margin-top:60px;"></div>
    <div class="container" >
        <div class="row">
            {{-- User banner --}}
            <div class="col-lg-9 col-md-9 col-sm-9">
                <div class="thumbnail thumbnail-tune" style='margin-top:30px; padding-bottom:40px; margin-bottom:10px;'>
                    <div id='pongo-seat' style='display:none'>
                        <img src={{asset('imgs/avartar-samurai.svg')}} class='mini-avatar mini-avatar-opposite pull-right' data-toggle='tooltip-pongo' data-placement='left' title="Pongo here">
                    </div>
                    <div>
                        <img src={{asset(Auth::user()->profile_picture)}} class='avatar avatar-opposite'>
                    </div>
                    <small class='pull-right label label-success solid-rank solid-text-light-two pull-care-minimum'> <b>{{Auth::user()->bank != null ? Auth::user()->bank->coins : '0'}}</b> </small>
                    <button class='pull-right merge-currency solid-two-light pull-care-minimum'></button>
                    <h1 class="panel-title  dark-knight pull-care-minimum"><b>{{ 'Welcome '.Auth::user()->name }} </b>
                        <span class=' {{ 'label label-default dark-knight solid-rank '.Auth::user()->rank}} '>{{Auth::user()->rank}}</span>
                    </h1>
                </div>
                {{-- search --}}
                <div class="thumbnail-tune thumbnail" style='padding-bottom:25px'>
                    <h1 class='panel-title pull-left dark-knight' style='margin-top:10px;'>All
                        <span class='badge pink-panther solid-text-light-two solid-two-light'>{{count(Auth::user()->notes)}}</span>
                    </h1><small class='pull-left' style='margin-right:10px; opacity:0'>gfgh</small>

                    <button type='button' class='pull-right btn btn-default ' data-toggled='false' id='B-down'><span class='caret'></span></button><small class='pull-right' style=' opacity:0'>g</small>
                    <a href="{{ route('make.note') }}"  class='btn btn-primary pull-right' ><span class="glyphicon glyphicon-comment"></span></a>
                    <input type='name' class='form-control phone-width'  placeholder="search for a piece">
                </div>
                {{-- INSTRUCTIONS BAR --}}
                @if(Auth::user()->new == 1)

                @else
                    <div id='instructions-Bar'>
                        <img src="{{asset('imgs/avartar-samurai.svg')}}" class='img-responsive avatar-pongo solid'  data-toggle='tooltip' data-placement='right' title="Pongo">

                        <div class='box dark-knight solid-two' style='background:lightpink' >

                            <p class='text-center' id='pongo-message'>Hi! My name is Pongo.</p>
                        </div>
                    </div>
                @endif
                {{-- NOTIFICATION AREA --}}
                <div id='notification-area' class='' style='display:none'>
                    <img src="{{asset('imgs/avartar-samurai.svg')}}" class='img-responsive avatar-pongo solid'  data-toggle='tooltip' data-placement='right' title="Pongo">
                    <div class='thumbnail-tune thumbnail solid-two' style='background:maroon' >
                        <center>
                            <h4 class='solid-text-light-two' style='color:white' id=''>Notifications</h4>
                            <div class='cover-piece-text solid-rank' style='background-color:black; border-color:white; width:70%; color:white;'>
                                <small> Somebody just coined you.</small>
                            </div>
                            <div class='cover-piece-text solid-rank' style='background-color:white; border-color:black; width:70%; color:black;'>
                                <small> Behold, thou hast become shakespare.</small>
                            </div>
                        </center>
                    </div>
                </div>
                <!-- ALL PIECES TAKE THIS FORM -->
                <div id='piece-board' class=' col-xs-12' style='display:none'>
                    @forelse($notes as $note)
                        <div class='thumbnail thumbnail-tune clearfix' style='margin-bottom:5px;'>
                            <div class='{{Auth::user()->rank}}-pin solid-two-light pull-left pull-care'></div><small class='pull-left' style='opacity:0'>d</small>
                            <label class='dark-knight pull-care'>{{$note->title}}</label><small> " {{substr(Crypt::decryptString($note->note),0,40).'...'}} "</small>
                            <button class='merge-currency solid-rank'></button><small>{{ $note->published !=false ? count($note->publish->bank->coins) :'0'}}</small>
                            <small class='fontlize'>
                                <span class=' dark-knight'>
                                    <span class='glyphicon glyphicon-comment '></span>
                                     {{ $note->published != false ? count($note->publish->comments) : '0'}}</span>
                            </small>
                            <small class='fontlize'>
                                <span class='dark-knight'>
                                    <span class='glyphicon glyphicon-thumbs-up '></span>
                                    {{$note->publshed !=false ? count($note->publish->likes) : '0'}}</span>
                            </small>
                            @if($note->published)
                                <a href='{{route('see.note',$note->id)}}' class='btn btn-default pull-right' style='background-color:orange; color:black;' data-toggle='tooltip' data-placement='left' title='{{$note->title.' has been published'}}'><span class='glyphicon glyphicon-eye-open' ></span></a>
                            @else
                                <a href='{{route('see.note',$note->id)}}' class='btn btn-default pull-right'><span class='glyphicon glyphicon-eye-open'></span></a>
                            @endif
                            <small style='opacity:0' class='pull-right'>gf</small>
                            <small class='label label-default solid-rank pull-right pull-care'>{{$note->created_at->diffForHumans()}}</small>
                        </div>
                    @empty
                        <div class='box'>
                            <p>{{Auth::user()->rank=='shakespare' ? Auth::user()->name.' people are waiting to learn from you please publish something!': Auth::user()->name.'! dont be shy everyone is ther to help you out. Publish something.' }} </p>
                        </div>
                    @endforelse
                    @if(count($notes) >= 6)
                        <div class='thumbnail thumbnail-tune'>
                            {{$notes->links()}}
                        </div>
                    @endif
                </div>

            </div>

            <div class='col-lg-3 col-md-3 col-sm-3 col-xs-12 ' >
                <div class='thumbnail solid-two-light' style='margin-top:30px; margin-bottom:10px;'>
                    <center>    <strong> <h5 class='solid-text-light dark-knight'><span class='glyphicon glyphicon-book' style='color:orange;'></span> {{ Session::get('username')}}'s books <span class='badge'>{{count($user_Books)}}</span></h5></strong></center>
                </div>
                    <a class='btn btn-success solid-two-light' data-toggle='modal' data-target='#book-Name' style='width:100%; margin-bottom:7px;'><span class='glyphicon glyphicon-plus'></span> New Book</a>
                    @forelse($user_Books as $book)
                        <a href='{{ route('book.view',$book->id) }}' class='btn btn-default solid-two-light' style='width:100%;  margin-bottom:7px;'>
                            {{ count(str_split($book->Title)) >18 ? substr($book->Title,0,17).'...' : $book->Title  }}
                        </a>
                    @empty
                        <a class='btn btn-default solid-two-light' style='width:100%; margin-bottom:7px;'>You have no books!</a>
                    @endforelse
            </div>
        </div>
    </div>

<style>
    #allPane{
        position:relative;

    }
    #boxes{
        width:20px;
        height:20px;
    }
    .pinkize{
        background-color: deeppink;
    }
</style>
@endsection

@section('scripts')
    <script src="{{ asset('js/merge.js') }}"></script>
@endsection
