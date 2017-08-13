$('body').css('display','none');
  $(document).ready(function(){
        $('body').fadeIn(800);
        $('#meTymNav').animate({fontSize:'25px'},700);
        $('#seePane').animate({top:'70px'},1300);

        $('#skeleton-button').on('click',function(){
            var text = $('#keep-skeleton').text();
            $('#piece-skeleton-page').html(function(){
                return text;
            });
        });

        $('#show-comments').on('click',function(event){
            event.preventDefault();
            var This = $(this);
            var toggle_value = This.attr('data-toggled');
            if (toggle_value =='true'){
                $("#comment-box").slideUp(500);
                This.attr('data-toggled','false');
            }else{
                $("#comment-box").slideDown(500);
                This.attr('data-toggled','true');
            }


        });

        $('[data-toggle="tooltip"]').tooltip();



    });
    //  END OF DOCUMENT READY
