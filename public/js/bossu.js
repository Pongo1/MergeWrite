$('body').css('display','none');

    //-------------------------------------------------------- DOCUMENT READY -------------------------------------------------
 $(document).ready(function(){
    $('body').fadeIn(300);
    $('[data-toggle="tooltip"]').tooltip();



    var mech = function(){
        event.preventDefault();
        $.ajax({
            method:'get',
            url:'/bossu-authenticated',
            data:{bossuPassword:$('input[name=bossuPassword]').val()}

        }).done(function(){
            $('#login-form').load('/refresh-bossu').hide().fadeOut(200).fadeIn(400);
        });
    }
    $('#go').on('click',function(event){
        mech();
    });
    $('#bossu-token').on('keypress',function(e){
        if(e.which ==13){
            mech();
        }

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

});
