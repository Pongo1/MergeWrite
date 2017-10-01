@if(Auth::user()->is_mentor)
    <center>
        <h4 class='dark-knight'>{{Auth::user()->name.' '}}</h4>
        <button class='btn btn-default solid-rank btn-large remarks-color' data-toggle='popover' data-title='Mentor score and remarks' data-placement='bottom' data-html='true' data-content='
            <form action="/mentor-mark" class="clearfix" method="get">
                <textarea name="remarks" rows="6" class="form-control" style="width:100%" placeholder="This can be left empty, but it would very nice if you let your mentee know your thoughts."></textarea>
                <input type="hidden" name="piece_id" value="{{$found_note->id}}">
                <button class="btn btn-success btn-sm solid-rank pull-right" style="margin:5px 5px;"><span class="glyphicon glyphicon-ok" ></span> Mark</button>
                <input type="number" name="mark_coins" value="10" class="form-control" style="width:65%; margin:2px" max="100">
            </form>
        ' >Add remarks and score</button>
    </center>

@else
    <center>
        <h3 class='dark-knight solid-text-light-two'>MENTORS</h3>
        <p class='dark-knight'>Before you publish anything, you can choose a mentor to let them see it first. They will read and bring out some vital information about your piece. Your mentor can grade you well with a few coins if your piece is worth it. Let them clean your piece up before you let it out into the world.</p>
    </center>
    @if($found_note->marked ==1)
        <center>
            <button class='btn btn-primary solid-rank btn-large receive-remark' data-toggle='popover' data-title='Mentor score and remarks' data-placement='top' data-html='true' data-content='
                <p class="dark-knight">{{$found_note->mentor_remark}}</p>
                <input type="text" class="form-control pull-right" value="{{$found_note->mark_coins.' coins'}}" style="background:black; color:white; width:90px; border:solid 3px crimson;" readonly>
            ' >Remarks from your mentor</button>
            <button type='button' id='seen' data-ID='{{$found_note->id}}'class='btn btn-success' style='background:green' data-toggle='tooltip' data-placement='top' title='Mark this as seen'><span class='glyphicon glyphicon-eye-open'></span></button>
        </center>
    @elseif ($found_note->marked==2)
        <div class="cover-piece-text solid-rank dark-knight" style='background:green; color:white;border-color:black;'>
            <p>Waiting for mentor...</p>
        </div>

    @else
        <div class="row">
            <div class='dropdown'>
                <input type="text" name="mentor_name" class='form-control pull-left' id='mentor-box' style='width:80%;' placeholder="Choose a mentor" value="">
                <input type="hidden" id="mentor_id" value="">
                <input type="hidden" id='piece-id-men' name="" value="{{$found_note->id}}">
                <input type="hidden" id='piece-title-men' name="" value="{{$found_note->title}}">
                <button type="button" data-toggle='dropdown' data-opened='false' class='dropdown-toggle btn btn-default ' id='mentor' name="button"><span class='caret'></span></button><button class='btn btn-success solid-rank' style='margin-left:5px;margin-right:5px; display:none' id='send-to-mentor'><span class='glyphicon glyphicon-send'></span> send</button>
                <ul class='dropdown-menu my-drop' role='menu' aria-labelledby="mentor" style='width:300px;' >
                    <li role='presentation'><small class='dropdown-header' >Choose a mentor</small></li>
                    <li role='presentation' class='divider'></li>
                    @forelse ($mentors as $mentor)
                            <li ><a  class=' mouse' data-ID='{{$mentor->id}}' >{{$mentor->name}}</a></li>
                    @empty
                            <li ><a  class=' mouse'  >There are no mentors available</a></li>
                    @endforelse
                </ul>
            </div>
        </div>
    @endif
@endif
