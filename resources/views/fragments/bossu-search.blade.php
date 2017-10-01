<h4 class='dark-knight text-center'><span class='glyphicon glyphicon-search'></span> Search results</h4>
@forelse ($same as $user)
    <div class="thumbnail thumbnail-tune clearfix solid-rank" style='border:solid 3px green;'>
            <h4 class='dark-knight solid-text-light-two'>{{$user->name}}</h4>
            <small>{{$user->email}}</small>
            <small>{{$user->name. ' has '.count($user->notes).' pieces.'}},</small>
            <small>Rank: {{$user->rank ? $user->rank->rank : 'No rank'}}</small>
            <div class="clearfix pull-right">
                @if($user->is_mentor ==1)
                    <button type="button"  class='btn btn-default solid-rank '  data-toggle='tooltip' data-placement='top' title='Already a mentor'>A mentor</button>
                @else
                    <button type="button"  class='btn btn-primary solid-rank mentor' data-ID='{{$user->id}}' data-toggle='tooltip' data-placement='top' title='Make this user a mentor'>Mentor</button>
                @endif
                <small style='opacity:0'></small>
                <button type="button" class='btn btn-danger solid-rank ' data-toggle='modal' data-target='#delete-{{$user->id}}'><span class='glyphicon glyphicon-trash'></span></button>
            </div>
    </div>
    <div class="modal fade" id='delete-{{$user->id}}'>
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <small class='dark-knight'>Would you like to delete {{$user->name}}'s account from merger write?</small>
                </div>
                <div class="modal-footer">
                    <a href='{{route('bossu.delete',$user->id)}}' class='btn btn-danger solid-rank'>Yes I want to</a>
                </div>
            </div>
        </div>
    </div>
@empty
    <p class='text text-danger text-center'>There were no results. The user might not exist</p>
@endforelse
        {{-- <p class='dark-knight text-center'>Users with similar name.</p>
        @forelse ($similar as $user)
            <div class="thumbnail thumbnail-tune clearfix solid-rank" style='border:solid 3px green;'>
                    <h4 class='dark-knight solid-text-light-two'>{{$user->name}}</h4>
                    <small>{{$user->email}}</small>
                    <small>{{$user->name. ' has '.count($user->notes).' pieces.'}},</small>
                    <small>Rank: {{$user->rank ? $user->rank->rank : 'No rank' }}</small>
                    <div class="clearfix pull-right">
                        <button type="button" name="user-" class='btn btn-primary solid-rank' data-toggle='tooltip' data-placement='top' title='Make this user a mentor'>Mentor</button>
                        <small style='opacity:0'></small>
                        <button type="button" class='btn btn-danger solid-rank ' name="user-delete-"><span class='glyphicon glyphicon-trash'></span></button>
                    </div>
            </div>
        @empty
            <p class='text text-danger text-center'>There were no users with similar results. </p>
        @endforelse --}}

<script type="text/javascript">
    $('[data-toggle="tooltip"]').tooltip();

    $('.mentor').on('click',function(event){
        var id = $(this).attr('data-ID');
        var This = $(this);
        $.ajax({
            method:'get',
            url:'/make-mentor/'+id
        }).done(function(){
            This.fadeOut(200);
            This.removeClass('btn-success');
            This.addClass('btn-default');
            This.attr('title','Already a mentor');
            This.text('A mentor');
            This.fadeIn(600);
        });
    });
    var search = function(){
        var name = document.getElementById("search-text").value;
       $.ajax({
           method:'get',
           url:'/'+name//hit some empty route
       }).done(function(){
           $('#results-box').load('/bossu-search/'+name).hide().fadeIn(500);
       });
    };
    $('#search-button').on('click',function(){
        search();
    });

    $('#search-text').on('keypress',function(e){
        if(e.which == 13){
            search();
        }
    });

</script>
