@extends('layouts.app')

@section('content')
    {{-- <div style="margin-top:60px;"></div>
 --}}    
    <div class="container" >
        <div class="row">
        <div class='thumbnail-tune top-banner clearfix' style='background: black; padding-top:2px;'>
            <div class='pull-left' style='border:solid 1px white;border-radius:10px;margin-right:10px; background: #282828; padding:5px;'>
                <button class='solid-two' style='border-radius:100%; height:5em;margin-top:10px; width:5em;background: Gold; border:solid 2px white;'></button>
                <h1 class='pull-right solid-text-light' style='font-size:2em; color:white; margin-top:30px;margin-left:10px; margin-right:10px; '> {{Auth::user()->bank != null ? Auth::user()->bank->coins : '0'}}</h1>
            </div>

                <h1 style='' class='noti-bell'><span class='glyphicon glyphicon-bell ' style='font-size:2em;  '></span><span class='badge'>{{count(Auth::user()->unreadNotifications) > 0 ? count(Auth::user()->unreadNotifications) :''}}</span></h1>


        </div>
        <div class='col-lg-6 col-md-6 '>
        </div>





            {{-- User banner --}}
            <div class="col-lg-9 col-md-6 col-md-offset-1 col-sm-9">
                <div class="thumbnail thumbnail-tune solid" style='margin-top:30px;border:solid 3px maroon; padding-bottom:40px; margin-bottom:10px;'>
                    <div id='pongo-seat' style='display:none'>
                        <img src={{asset('imgs/avartar-samurai.svg')}} class='mini-avatar mini-avatar-opposite pull-right' data-toggle='tooltip-pongo' data-placement='left' title="Pongo here">
                    </div>
                    <div>
                        <img src={{asset(Auth::user()->profile_picture)}} class='avatar avatar-opposite'>
                    </div>
                    <div class="pull-right">
                        <small class='pull-right label label-success solid-rank solid-text-light-two pull-care-minimum'> <b>{{Auth::user()->bank != null ? Auth::user()->bank->coins : '0'}}</b> </small>
                        <button class='pull-right merge-currency solid-two-light pull-care-minimum'></button>
                    </div>

                    <h1 class="panel-title  dark-knight pull-care-minimum"><b>{{ 'Welcome '.Auth::user()->name }} </b>
                        <span class=' {{ 'label label-default solid-rank '.Auth::user()->rank->rank}} '>{{Auth::user()->rank->rank}}</span>
                    </h1>


                </div>
                {{-- search --}}
                <div class="thumbnail-tune thumbnail" style='padding-bottom:25px'>
                    <h1 class='panel-title pull-left dark-knight' style='margin-top:10px;'>All
                        <span class='badge pink-panther solid-text-light-two solid-two-light'>{{count(Auth::user()->notes)}}</span>
                    </h1><small class='pull-left' style='margin-right:10px; opacity:0'>gfgh</small>

                    <button type='button' class='pull-right btn btn-default ' data-toggled='true' id='B-down'>
                        <span id='bell' class='glyphicon glyphicon-bell'></span>
                        <span id='bell-count' class='badge' style='font-size:8px;'>{{count(Auth::user()->unreadNotifications)}}</span>
                    </button>
                    <small class='pull-right' style=' opacity:0'>g</small>
                    <a href="{{ route('make.note') }}"  class='btn btn-primary pull-right' ><span class="glyphicon glyphicon-comment"></span></a>
                    <input type='name' class='form-control phone-width'  placeholder="search for a piece">
                </div>
                {{-- INSTRUCTIONS BAR --}}
                @if(Auth::user()->new == 1)
                @else
                    <div id='instructions-Bar'>
                        <img src="{{asset('imgs/avartar-samurai.svg')}}" class='img-responsive avatar-pongo solid'  data-toggle='tooltip' data-placement='right' title="Pongo">

                        <div class='thumbnail thumbnail-tune dark-knight solid-two clearfix' style='background:lightpink' >
                            <button type="button" class='btn btn-danger solid-rank btn-xs pull-right' data-toggle='tooltip' data-placement='top' title='I dont want to see this' id='dont-want-to'>Okay</button>
                            <p class='text-center' id='pongo-message'>Hi! My name is Pongo.</p>
                        </div>
                    </div>
                @endif
                {{-- NOTIFICATION AREA --}}
                <div id='notification-area' class='' style='display:none'>
                    <h4 class='solid-text-light-two text-center' style='color:white' id=''>
                        {{count(Auth::user()->unreadNotifications)==0 ? 'No':''}} Notifications
                        <span class='badge'>{{count(Auth::user()->unreadNotifications) > 0 ? count(Auth::user()->unreadNotifications) :''}}</span>
                        @if(count(Auth::user()->unreadNotifications) !=0)
                            <small class='mouse label label-primary' onclick="clearNotifications()">clear

                            </small>
                        @endif
                    </h4>
                        @if(count(Auth::user()->unreadNotifications) !=0)
                            <div class='thumbnail-tune thumbnail solid-two' style='background:maroon; max-height:500px; overflow-y:scroll;' >
                                <center>
                                    @foreach (Auth::user()->unreadNotifications as $N)
                                        <div class='cover-piece-text' style='background-color:white; border-color:black; width:70%; color:black; '>
                                            @foreach ($N->data as $key => $value)
                                                @if($key == 'liker')
                                                    <small> {{$N->data['liker']['name']}} likes your piece
                                                        <span style='font-style:italic'>
                                                            <b>{{$N->data['piece']['piece_title']}}.</b>
                                                            <b>{{$N->data['piece']['piece_title']}}</b>
                                                        </span> now has {{$N->data['coins']}} coins<br>
                                                        <span style='font-size:9px'>
                                                            <span class='badge' style='background-color:white; color:black;'><span class='glyphicon glyphicon-thumbs-up'></span>
                                                        </span>
                                                            {{$N->created_at->diffForHumans()}}</span>
                                                    </small>
                                                @elseif ($key =='grabber')
                                                    <small> {{$N->data['grabber']['name']}} grabbed
                                                        <span style='font-style:italic'>
                                                            <b>{{$N->data['piece']['piece_title']}}</b>
                                                        </span> <br>
                                                        <span class='badge' style='color:black; background-color:white;'>
                                                            <span class='glyphicon glyphicon-bookmark'></span>
                                                        </span>
                                                        <span style='font-size:9px'>
                                                            {{$N->created_at->diffForHumans()}}
                                                        </span>
                                                    </small>
                                                @elseif ($key == 'commenter')
                                                    <small> {{$N->data['commenter']['name']}} commented on
                                                        <span style='font-style:italic'>
                                                            <a href='/see-note/{{$N->data['piece']['id']}}'><b>{{$N->data['piece']['piece_title']}}</b></a>
                                                        </span><br>
                                                        <span style='font-size:9px'>
                                                            <span class='badge' style='background-color:white; color:black;'><span class='glyphicon glyphicon-comment'></span>
                                                        </span>
                                                            {{$N->created_at->diffForHumans()}}</span>
                                                    </small>
                                                @elseif ($key == 'admin')
                                                    <small> {{$N->data['admin']['name']}} shared her thoughts on
                                                        <span style='font-style:italic'>
                                                            <a href='/see-note/{{$N->data['piece']['id']}}'><b>{{$N->data['piece']['title']}}</b>.</a>
                                                        </span>You got {{$N->data['coins']}} more coins<br>
                                                        <span style='font-size:9px'>
                                                            <span class='badge' style='background-color:white; color:black;'><span class='glyphicon glyphicon-eye-open'></span>
                                                        </span>
                                                            {{$N->created_at->diffForHumans()}}</span>
                                                    </small>
                                                @elseif ($key == 'rank_change')
                                                    <small> You moved from <b><span class='text text-danger'>{{$N->data['oldName']}}</span></b> to
                                                        <span style='font-style:italic'>
                                                            <b><span class='text text-success'>{{$N->data['newName']}}</span></b>.
                                                        </span><br>
                                                        <span style='font-size:9px'>
                                                            <span class='badge' style='background-color:white; color:black;'><span class='glyphicon glyphicon-sort'></span>
                                                        </span>
                                                            {{$N->created_at->diffForHumans()}}</span>
                                                    </small>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endforeach
                                </center>
                            </div>
                        @endif
                </div>
                <!-- ALL PIECES TAKE THIS FORM -->
                <div id='piece-board' class='' style=''>
                    @forelse($notes as $note)
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class='panel panel-default clearfix' style='margin-bottom:5px; '>
                                <div class="panel-heading" >
                                    <h1 class='panel-title' class='dark-knight pull-care'>{{$note->title}} <span class='text text-success {{$note->marked== 1 ? 'glyphicon glyphicon-ok' : ''}}' ></span></h1>
                                </div>
                                <div class="panel-body">
                                    <small> " {{substr($note->note,0,250).'...'}} "</small>
                                </div>
                                <div class="panel-footer clearfix">
                                    <button class='merge-currency solid-rank'></button><small>{{ $note->published !=false ? $note->publish->bank->coins   :'0'}}</small>
                                    <small class='fontlize label label-default broni' >
                                        <span>
                                             {{ $note->published != false ? count($note->publish->comments) : '0'}}</span>
                                             <span class='glyphicon glyphicon-comment '></span>
                                    </small>
                                    <small class='fontlize label label-danger broni' >
                                        <span >
                                            {{$note->published !=false ? count($note->publish->likes) : '0'}}</span>
                                            <span class='glyphicon glyphicon-thumbs-up '></span>
                                    </small>
                                    <small class='fontlize label label-default broni' style='background:crimson' >
                                        <span>
                                             {{ $note->published != false ? $note->publish->grabbers != null ? count($note->publish->grabbers)==0 ? 'No ' : count($note->publish->grabbers) : ' No': ' No '}} grabber{{count($note->publish->grabbers) ==1 ? '' : 's'}} </span>
                                    </small>
                                    @if($note->published)
                                        <a href='{{route('see.note',$note->id)}}' class='btn btn-default pull-right' style='background-color:orange; color:black;' data-toggle='tooltip' data-placement='left' title='{{$note->title.' has been published'}}'><span class='glyphicon glyphicon-eye-open' ></span></a>
                                    @else
                                        <a href='{{route('see.note',$note->id)}}' class='btn btn-default pull-right'><span class='glyphicon glyphicon-eye-open'></span></a>
                                    @endif
                                    <small style='opacity:0' class='pull-right'>gf</small>
                                    <small class='text text-muted  pull-right pull-care'>{{$note->created_at->diffForHumans()}}</small>
                                </div>
                            </div>
                        </div>

                    @empty
                        <div class='thumbnail thumbnail-tune'>

                            <p>{{Auth::user()->rank->rank=='shakespare' ? Auth::user()->name.' people are waiting to learn from you please publish something!': Auth::user()->name.'! dont be shy everyone is ther to help you out. Publish something.' }} </p>
                        </div>
                    @endforelse
                    @if(count($notes) >= 6)
                        <div class='thumbnail thumbnail-tune'>
                            {{$notes->links()}}
                        </div>
                    @endif
                </div>
            </div>

                       {{--  <div class='col-lg-3 col-md-3 col-sm-3 col-xs-12 ' >
                            <div class='thumbnail solid-two-light clearfix' style='margin-top:30px; margin-bottom:10px;'>
                                <button id='book-arrow-button' data-toggled='true' class='btn btn-default btn-sm pull-right' style='margin-top:7px;'><span class='caret'></span></button>
                                   <strong> <h5 class='solid-text-light dark-knight'><span class='glyphicon glyphicon-book' style='color:orange;padding-left:35px;margin-top:5px;'></span> {{ Auth::user()->name}}'s books <span class='badge'>{{count($user_Books)}}</span></h5></strong>
                            </div>
                            <div class="thumbnail thumbnail-tune" id='book-shelf'>
                                <a class='btn btn-success solid-two-light' data-toggle='modal' data-target='#book-Name' style='width:100%; margin-bottom:7px;'><span class='glyphicon glyphicon-plus'></span> New Book</a>
                                @forelse($user_Books as $book)
                                    <a href='{{ route('book.view',$book->id) }}' class='btn btn-default solid-two-light' style='width:100%;  margin-bottom:7px;'>
                                        {{ count(str_split($book->Title)) >18 ? substr($book->Title,0,17).'...' : $book->Title  }}
                                    </a>
                                @empty
                                    <a class='btn btn-default solid-two-light' style='width:100%; margin-bottom:7px;'>You have no books!</a>
                                @endforelse
                            </div>
 --}}
                        {{-- USER's GRABS --}}
                          {{--   <div class='thumbnail solid-two-light clearfix' style='margin-top:30px; margin-bottom:10px;'>
                                <button id='grabs-arrow-button' data-toggled='true' class='btn btn-default btn-sm pull-right' style='margin-top:7px;'><span class='caret'></span></button>
                                   <strong> <h5 class='solid-text-light dark-knight'><span class='glyphicon glyphicon-bookmark' style='color:crimson;padding-left:35px;margin-top:5px;'></span> Your Grabs <span class='badge'>{{count(Auth::user()->grabs)}}</span></h5></strong>
                            </div>
                            <div class="thumbnail thumbnail-tune" id='grabs-board' style='padding-left:10px; padding-right:10px;'>

                                @forelse(Auth::user()->grabs as $grabbed)
                                    <form action="{{route('piece.full',$grabbed->piece_title)}}" method="post">
                                        {{csrf_field()}}
                                        <input type="hidden" name="piece_id" value="{{$grabbed->id}}">
                                        <button type='submit' class='btn btn-default solid-two-light' id='{{ 'grab-button-'.$grabbed->id}}' style='width:80%;margin-bottom:7px;'>
                                            {{ count(str_split($grabbed->piece_title)) > 18 ? substr($grabbed->piece_title,0,17).'...' : $grabbed->piece_title  }}
                                        </button>
                                        <button class='btn btn-danger solid-two-light grab-delete' data-ID='{{$grabbed->id}}' type='button'><span class='glyphicon glyphicon-trash'></span></button>
                                    </form>
                                @empty
                                    <a class='btn btn-default solid-two-light' style='width:100%; margin-bottom:7px;'>You haven't grabbed anything yet!</a>
                                @endforelse
                            </div>

                        </div>
                    </div>
                </div> --}}
    <!-- SHOP BOOK MODAL -->
    <div class='modal fade' id='shop-modal'>
        <div class='modal-dialog modal-md' >
            <div class='modal-content' style='background-color: #282828;border:solid 3px crimson;'>
                <div class="modal-header" style='border-width:0px;'>
                     <button data-dismiss='modal' aria-hidden="true" style='color:white' class='close'>x</button>
                </div>
                 <div class="modal-body" style='max-height:500px; overflow-y:scroll' id='shop-page'>

                     @forelse ($shopItems as $Rank)
                         <div class="thumbnail thumbnail-tune solid-rank clearfix" style='max-height:350px; overflow-y:scroll; {{ Auth::user()->rank->rank == $Rank->rank ? 'border: solid 3px cyan' : ''}}'>
                             <div class="{{'cover-piece-text solid-rank '.$Rank->rank}}" style='{{$Rank->rank =='Siphiwe' ? 'border-color:white;' : 'border-color:black;'}}'>
                                 <h2>{{$Rank->rank}}</h2>
                             </div>

                             <p class='dark-knight '>{{$Rank->rank_description}}</p>
                             <small class='dark-knight'>With this rank, your likes will be worth {{$Rank->rank_worth/2}} coins.</small>
                             @if(Auth::user()->rank->number < $Rank->id)
                                 <button class='btn btn-primary pull-right solid-rank' data-toggle='tooltip' data-placement='top' title='You have passed {{$Rank->rank}}'><span class='glyphicon glyphicon-ok'></span></button>
                             @elseif (Auth::user()->rank->number == $Rank->id)
                                 <button class='btn btn-success pull-right solid-rank {{$Rank->rank}}' data-toggle='tooltip' data-placement='top' title='You are a {{$Rank->rank}}'>Aquired</button>
                             @else
                                 @if(Auth::user()->bank->coins >= $Rank->rank_cost)
                                     <button class='btn btn-success solid-rank pull-right rank-buy' data-rankName ='{{$Rank->rank}}' data-toggle='tooltip' data-placement='top' title='Aquire this rank'>{{$Rank->rank_cost}}</button>
                                 @else
                                     <button class='btn btn-default pull-right solid-rank not-buy' data-toggle='tooltip' data-placement='top' title='You cannot advance to {{$Rank->rank}}.  You do not have enough coins, keep writing'>{{$Rank->rank_cost}}</button>
                                 @endif
                            @endif
                         </div>
                     @empty

                     @endforelse
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
<script>
    var clearNotifications = function(){
        $.get('/mark-as-read');
        location.reload();
    };
</script>
@endsection

@section('scripts')
    <script src="{{ asset('js/merge.js') }}"></script>
    <script src="{{ asset('js/universal.js') }}"></script>
@endsection
