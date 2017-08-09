@extends('layouts.app')

@section('content')
<div style="margin-top:60px;"></div>
    <div class="container" style='overflow-x:hidden'>
        <div class="row">
            {{-- BOOKS SIDE --}}
            <div class='col-lg-3 col-md-3 col-sm-12 col-xs-12 margin-care' style='margin-right:0px;'>
                <div class='thumbnail solid-two-light'>
                    <center>    <strong> <h5 class='solid-text-light dark-knight'><span class='glyphicon glyphicon-book' style='color:orange;'></span> {{ Session::get('username')}}'s books <span class='badge'>{{count($user_Books)}}</span></h5></strong></center>
                </div>
                    <a class='btn btn-success solid-two-light' data-toggle='modal' data-target='#book-Name' style='width:100%; margin-bottom:7px;'><span class='glyphicon glyphicon-plus'></span> New Book</a>
                    @forelse($user_Books as $book)
                        <a href='{{ route('book.view',$book->id) }}' class='btn btn-default solid-two-light' style='width:100%;         margin-bottom:7px;'>
                            {{ count(str_split($book->Title)) >18 ? substr($book->Title,0,17).'...' : $book->Title  }}
                        </a>
                    @empty
                        <a class='btn btn-default solid-two-light' style='width:100%; margin-bottom:7px;'>You have no books!</a>
                    @endforelse
            </div>

            <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12" id="allPane">
                @if(Session::has('success'))
                    <p class="alert alert-success">{{ Session::get('success') }}</p>
                @endif

                {{-- USER BANNER --}}
                <div class=" box solid-two-light clearfix pull-care-maximum"  >
                    <div id='pongo-seat' style='display:none'>
                        <img src={{asset('imgs/avartar-samurai.svg')}} class='mini-avatar mini-avatar-opposite pull-right' data-toggle='tooltip-pongo' data-placement='left' title="Pongo here">
                    </div>
                    <div>
                        <img src={{asset('imgs/avatar-black.png')}} class='avatar avatar-opposite'>
                    </div>

                        <small class='pull-right label label-success solid-rank solid-text-light-two pull-care-minimum'> <b>{{Auth::user()->mc}}</b> </small>
                        <button class='pull-right merge-currency solid-two-light pull-care-minimum'></button>
                        <h1 class="panel-title  dark-knight pull-care-minimum"><b>{{ 'Welcome '.Auth::user()->name }} </b>
                            <span class=' {{ 'label label-default dark-knight solid-rank '.Auth::user()->rank}} '>{{Auth::user()->rank}}</span>
                        </h1>
                    </div>

                    {{-- SEARCH BAR --}}
                    <div class='box clearfix solid-two-light'>
                        <h1 class='panel-title pull-left dark-knight' style='margin-top:10px;'>Your pieces
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
                        <div class='box dark-knight solid-two' style='background:lightpink' >
                            <center>
                                <h4 class='' id=''>Notifications</h4>
                                <div class='notifier solid-two' style='background-color:black; color:white;'>
                                    <small> Somebody just coined you.</small>
                                </div>
                                <div class='notifier solid-two' style='background-color:black; color:white;'>
                                    <small> Behold, thou hast become shakespare.</small>
                                </div>
                            </center>
                        </div>
                    </div>
                    <!-- ALL PIECES TAKE THIS FORM -->
                    <div id='piece-board' class=' col-xs-12' style='display:none'>
                        @forelse($notes as $note)
                            <div class='mini-box clearfix' style=''>
                                <div class='{{Auth::user()->rank}}-pin solid-two-light pull-left pull-care'></div><small class='pull-left' style='opacity:0'>d</small>
                                <label class='dark-knight pull-care'>{{$note->title}}</label><small> " {{substr(Crypt::decryptString($note->note),0,40).'...'}} "</small>
                                <button class='merge-currency solid-rank'></button><small>65</small>
                                <small class='fontlize'><span class='glyphicon glyphicon-comment'></span> 400 </small>
                                <small class='fontlize'><span class='glyphicon glyphicon-thumbs-up'></span> 490K </small>

                                <a href='{{route('see.note',$note->id)}}' class='btn btn-default pull-right'><span class='glyphicon glyphicon-eye-open'></span></a>
                                <small style='opacity:0' class='pull-right'>gf</small>
                                <small class='label label-default solid-rank pull-right pull-care'>{{$note->created_at->diffForHumans()}}</small>
                            </div>
                        @empty
                            <div class='box'>
                                <p>{{Auth::user()->rank=='shakespare' ? Auth::user()->name.' people are waiting to learn from you please publish something!': Auth::user()->name.'! dont be shy everyone is ther to help you out. Publish something.' }} </p>
                            </div>
                        @endforelse
                        @if(count($notes) >= 6)
                            <div class='mini-box'>
                                {{$notes->links()}}
                            </div>
                        @endif
                    </div>
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
