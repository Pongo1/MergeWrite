@extends('layouts.app')

@section('content')
    <div style='margin-top:60px;'></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="thumbnail solid-two-light thumbnail-tune clearfix" style='padding-left:10px; padding-right:10px;'>
                    <h3 class='dark-knight solid-text-light-two clearfix'>{{$found->piece_title}} <span><small class='cover-piece-text pull-right dark-knight solid-rank' style='font-size:0.5em; border-color:black;background-color:gold; border-radius:0;'>Owner: {{$found->publisher_name}} <span class='{{'label label-default dark-knight '.$found->publisher_rank}}'> {{$found->publisher_rank}}</span></small></span></h3>

                    <pre style='cursor:pointer; 'class='cute-page cover-piece-text'>{{$found->piece_body}}</pre>
                    <div style='margin-top:15px'></div>
                    <div class='cover-piece-text pull-right ' style='border-color:black;'><small class='dark-knight'>Rate: </small><button class='merge-currency solid-rank' style='background:orange'></button>
                    <button class='merge-currency solid-rank' style='background:orange' ></button>
                    <button class='merge-currency solid-rank' style='background:orange'></button>
                    <button class='merge-currency solid-rank' style='background:orange'></button>
                    <button class='merge-currency solid-rank' style='background:orange'></button></div>
                    <small class='text text-success' style='margin-top:55px;'>{{'Published '.$found->created_at->diffForHumans().' by '.$found->publisher_name}}</small>
                    <small style='opacity:0'>sd</small>
                    <button type="button" class='merge-currency solid-rank' name="button"></button><small class='dark-knight'>50 coins</small>


                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="thumbnail solid-two-light thumbnail-tune" style='padding-left:10px; padding-right:10px;'>
                    <h3 class='solid-text-light-two dark-knight'>{{$found->piece_title}} skeleton</h3>
                    <div class="cover-piece-text" style='margin-top:30px;'>
                        <textarea name="....." style='display:none; ' id='fullview-skeleton-container' rows="8" cols="80">{{$found->skeleton_form}}</textarea>
                        <p class='cute-page dark-knight' id='fullview-skeleton-page' style='cursor:pointer'></p>
                    </div>

                    @if(count($found->comments) > 0)
                        <button type="button" id='comment-button' data-toggled='false' class='btn btn-default solid-rank dark-knight' style='margin-top:5px;' name="button"> Comments
                            <span id='post-badge' class='badge' >{{count($found->comments)}}</span>

                        </button>
                    @else
                        <button type="button" id='comment-button' data-toggled='false' class='btn btn-default solid-rank dark-knight' style='margin-top:5px;' name="button"> Comments <span class='glyphicon glyphicon-comment' ></span></button>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6"  style='display :none' id='comment-on-box'>
                <div class="thumbnail thumbnail-tune" style='border:solid 2px maroon;'>
                    <h4 class='dark-knight'>Comment on {{$found->piece_title}}</h4>
                    <hr class='normal-merge-div'>
                    <div class="form-group clearfix">
                        <input type="hidden" id="piece-id"  value="{{$found->id}}">
                        <textarea id="comment" class='form-control' style='border:solid 2px maroon; border-radius:10px;' rows="5" cols="80"></textarea>
                        <button style='width:100px; margin-top:7px;' type="button" name="" id='post' class='btn btn-default solid-rank dark-knight pull-right '>Post</button>
                    </div>
                </div>
            </div>
            {{-- Note, comment box is different from all comment box... loool --}}
            <div class="col-lg-6 col-md-6"  style='display :none' id='all-comments-box'>
                <div class="thumbnail thumbnail-tune" style='border:solid 2px;border-color:maroon; '>
                    <h4 class='dark-knight'>All comments on {{$found->piece_title}}</h4>
                    <hr class='normal-merge-div'>
                    <div style='maroon;min-height:185px; max-height:185px; overflow-y:scroll;' id='comment-box'>
                        @if(count($found->comments) > 0)
                            @foreach ($found->comments as $comment)
                                <div class=" cover-piece-text" style='border-color:black; border-width:1px;' >
                                    <h5 class='label label-default solid-rank solid-text-light-two' style='background-color:purple'>{{$comment->user->name}}</h5>
                                    <small style='opacity:0'></small>
                                    <span class='{{'label label default solid-rank dark-knight '.$comment->user->rank}}' >{{$comment->user->rank}}</span>
                                    <small class='text-center dark-knight'>{{$comment->comment}}</small>
                                </div>
                            @endforeach
                        @else
                            <center>
                                <small>No comments!</small>
                            </center>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    var makeCommentUrl = '{{route('comment.make')}}';
</script>
@endsection
@section('scripts')
    <script src="{{ asset('js/published.js') }}"></script>
@endsection
