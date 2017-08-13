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
<small style='display:none' id='number-of-comments'>{{count($found->comments)}}</small>
