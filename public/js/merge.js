$('body').css('display','none');
  $(document).ready(function(){
    $('body').fadeIn(800);
    $('#meTym').animate({fontSize:'100px'},1000);

    //Pongo's talking mechanism

    setTimeout(function(){
        var s = document.getElementById('pongo-message');
        s.innerHTML = 'I can tell you are new here?';

        setTimeout(function(){
            var s = document.getElementById('pongo-message');
            s.innerHTML = "You are a 'peeker'. Its a good thing, it means you are here to learn. ";
            setTimeout(function(){
                var s = document.getElementById('pongo-message');
                s.innerHTML = " I will guide your through the way things here. Just put your finger on anything and I will tell you what it is. ";
                setTimeout(function(){
                    var s = document.getElementById('pongo-message');
                    s.innerHTML = " You can disable me if you want, just click on your name and go to your settings. I hope you won't do that. Nice to meet you! Bye for now, I will be hiding up there. Look up! ";
                    setTimeout(function(){
                        $('#instructions-Bar').fadeOut(3000,function(){
                            $('#pongo-seat').show(2000,function(){
                                $(function(){
                                    $('[data-toggle="tooltip-pongo"]').tooltip().tooltip('show')
                                });
                            });
                        });
                    },10000);
                },7000);
            },7000);
        },7000);
    },5000)



    $(function(){
        $('[data-toggle="tooltip"]').tooltip()
    });


    //show notifcations ----------------------------------------
    $('#B-down').on('click',function(event){
        event.preventDefault();

        var This = $(this);
        var toggled_value = This.attr('data-toggled');
        if(toggled_value == 'true'){
            $('#piece-board').hide(300,function(){
                This.attr('data-toggled','false');
                $('#notification-area').fadeIn(500,function(){
                    $('#pongo-seat').hide(100);
                });
            });
        }else{

            $('#notification-area').fadeOut(500, function(){
                $('#piece-board').fadeIn(300);
                This.attr('data-toggled','true');
                $('#pongo-seat').show(100);
            });
        }
    });
    //----------------------------------------------------------- END OF SHOW NOTIFICATIONS -----------------------------------------------------------------



        //activate popover
        $(function(){
            $("[data-toggle='popover']").popover({
                delay:100

            });
        });


    //---------------------OTHER --------------------


    $('#signIn').animate({left:'280px'},1500);
    $('#meTymNav').animate({fontSize:'25px'},700);
    $('#signUp').animate({right:'260px'},1500);

    $('#loginPane').animate({top:'40px'},1500, function(){
    });
    $('#makePane').animate({height:'450px'},1000);

    $('#regPane').animate({top:'40px'},1500);
    $('#allPane').animate({width:'770px'},500);

//End of After body-loads effects
  });
setTimeout(function(){
  $('body').fadeIn(700);
},1000)
//-----------------------------------------------------------------------------------------------------------------------------




    // //--------------------_SCROLL EFFECT ----------------------------
    // $(window).on("load",function(){
    //     $(window).scroll(function(){
    //         var windowBottom = $(this).scrollTop() + $(this).innerHeight();
    //         $(".piece-post").each(function(){
    //
    //             var objectBottom = $(this).offset().top + $(this).outerHeight();
    //
    //             if(objectBottom < windowBottom){
    //                 if($(this).css("opacity")==0.3){
    //                     $(this).fadeTo(500,1);
    //                 }
    //             }else{
    //                 if($(this).css("opacity") == 1){
    //                     $(this).fadeTo(500,0.3);
    //                 }
    //             }
    //         });
    //
    //     }).scroll();
    // });
    // //------------------------------------------------------ END OF SCROLL EFFECT-----------------------------------------
