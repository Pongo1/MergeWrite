@extends('layouts.app')
@section('content')
    <div class="" style='margin-top:70px'></div>
    <div class="container" style='min-height:100%'>
        <div class="row">
            <div class="col-lg-6 col-md-offset-3 col-md-6 col-sm-8 col-sm-offset-1 col-xs-12">

                <div class="thumbnail-tune thumbnail clearfix solid-rank" style='border:solid 3px white; opacity:0' id='first-board'>
                    <div class="pull-left">
                        <img src='{{asset(Auth::user()->profile_picture)}}' class='img-responsive img-thumbnail avatar-square'>
                    </div>
                    <h2 class='dark-knight solid-text-light-two'>Welcome mentor {{Auth::user()->name}}</h2><small class='label label-default Siphiwe solid-rank solid-text-light-two mouse'>SIPHIWE</small>
                    <center>
                        {{Auth::user()->name}}, please visit the invitation links that your mentees have sent you below. They need you. Read their piece, share your thoughts and grade them with coins.
                        You are a siphiwe, people have to learn from you, please teach your mentees how to be cool.
                    </center>
                </div>
                <div class="thumbnail thumbnail-tune" style='min-height:300px; max-height:500px;border:solid 2px white; overflow-y:scroll; opacity:0' id='second-board'>
                    <h4 class='dark-knight solid-text-light-two text-center'>All invites from mentees</h4>
                    <hr class='normal-merge-div' style='margin-top:2px;'>
                    @forelse ($invites as $invitation)
                        <div class="thumbnail solid-two-light clearfix" id = 'whole-{{$invitation->id}}'style=' border-radius:0px; padding:8px;border:solid 2px black;margin-bottom:3px;'>
                            <div class="pull-left pull-care">
                                <p class='dark-knight'><span class='solid-text-light-two'><b>{{$invitation->inviter_name}}</b></span> <span><small>{{$invitation->piece_title}}</small><small> 300 words</small></span></p>

                            </div>
                            <div class="pull-right">
                                <a href='{{$invitation->link}}' class='btn btn-primary Chimamanda solid-rank' data-toggle='tooltip' data-placement='top' title='Go to piece'>Visit <span class='glyphicon glyphicon-forward'></span></a>
                                @if($invitation->note->marked ==1)
                                    <button class='btn btn-success solid-rank Okri done-button'  data-ID='{{$invitation->id}}' data-toggle='tooltip' data-placement='top' title='Mark as done'>Done</button>
                                @else
                                    <button class='btn btn-danger solid-rank delete-button'  data-ID='{{$invitation->id}}' data-toggle='tooltip' data-placement='top' title='I dont want to see this'><span class='glyphicon glyphicon-trash'></span></button>
                                @endif

                            </div>
                        </div>
                    @empty
                        <div class="thumbnail solid-two-light clearfix" style=' border-radius:0px; padding:8px;border:solid 2px black'>
                            <p>You have no invites! Please stay around, and keep checking.</p>
                        </div>
                    @endforelse

                </div>

            </div>

        </div>

    </div>

@endsection

@section('scripts')
<script src="{{asset('js/mentor.js')}}" charset="utf-8"></script>
@endsection
