@if(Session::has('bossu-authenticated'))
    <div class="thumbnail thumbnail-tune clearfix solid-two" style='margin-top:140px;padding-bottom:60px;border:solid 3px white;'>
        <h2 class='text-center dark-knight'>Search</h2>
        <center>
            <small class='text text-muted'>You can look for any user here!</small><br>
            @if(Session::has('success'))
                <small class='text text-success'>{{Session::get('success')}}</small>
            @endif

        </center>
        <button type="button" name="search" id='search-button' class='btn btn-success pull-right solid-rank solid-text-light-two'>
            <span class='glyphicon glyphicon-search'></span>
        </button>
        <input type="text" name="text" value="" id='search-text' placeholder="type a username" class='form-control' style='width:90%;border:solid 2px green;'>
    </div>
    <div class="thumbnail thumbnail-tune solid-two" id='results-box' style='border:solid 3px white; min-height:250px; max-height:600px; overflow-y:scroll;'>
        <h4 class='dark-knight text-center'><span class='glyphicon glyphicon-search'></span> Search results</h4>
    </div>
@else
    <div class="thumbnail thumbnail-tune solid clearfix" style='margin-top:140px;padding-bottom:60px;border:solid 3px white;'>
        <h3 class='dark-knight text-center solid-text-light-two'>Bossu login</h3>
        <center>
            <small>This is meant for the creators of merge write. If you find yourself here by any means and you know you are not a bossu, retract your steps.</small>
        </center>
        <br>
            <button type="button" id="go" class='btn btn-success pull-right solid-rank solid-text-light-two'><span  class=''></span>Go</button>
            <input type="password" name='bossuPassword'  id='bossu-token' autofocus='true' value="" placeholder="Enter bossu token" class='form-control solid-rank' style='width:90%;background:black;border:solid 3px crimson; color:white'>
            <small class='text text-danger'>{{Session::has('bossu-error') ? Session::get('bossu-error') :''}}</small>
            <br>
    </div>
@endif

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
    var mech = function(){
        $.ajax({
            method:'get',
            url:'/bossu-authenticated',
            data:{bossuPassword:$('input[name=bossuPassword]').val()}

        }).done(function(){
            $('#login-form').load('/refresh-bossu').hide().fadeOut(200).fadeIn(400);
        });
    };

    $('#go').on('click',function(event){
        mech();
    });
    $('#bossu-token').on('keypress',function(e){
        if(e.which ==13){
            mech();
        }
    });
</script>
