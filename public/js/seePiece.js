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

        $('#seen').on('click',function(){
            var piece_id = $(this).attr('data-ID');
            $.ajax({
                method:'get',
                url:'/mentee-mark-seen/'+piece_id
            }).done(function(){
                location.reload();
            });

        });

        //Animate comments drop down
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

        //Animate mentor names coming down
        $('.my-drop li').on('click',function(){
            var name = $(this).text();
            var mentorID = $(this).attr('data-ID');

            //alert(name);
            $('.my-drop').fadeOut(300,function(){
                document.getElementById("mentor-box").value = name;
                $('#mentor-box').css('width','60%');
                $('#send-to-mentor').fadeIn(100);
                $('#mentor').attr('data-opened','false');
                document.getElementById("mentor_id").value = mentorID;
            });
        });

        //send-invitation-to mentor
        $('#send-to-mentor').on('click',function(){
            var piece_title = document.getElementById("piece-title-men").value;
            var mentor_id = document.getElementById("mentor_id").value;
            var piece_id = document.getElementById("piece-id-men").value;
            $.ajax({
                method:'get',
                url:'/send-to-mentor/',
                data:{
                        piece_title:piece_title,
                        mentor_id:mentor_id,
                        piece_id:piece_id
                    }
            }).done(function(){
                $('#mentor-side').load('/refresh-mentee/'+piece_id).hide().fadeIn(500);
            });
        });

        $('#mentor').on('click',function(){
            if($(this).attr('data-opened') == 'false'){
                $('.my-drop').slideDown(400);
                $(this).attr('data-opened','true');
            }else{
                $('.my-drop').slideUp(400);
                $(this).attr('data-opened','false');

            }

        });
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover();



    });
    //  END OF DOCUMENT READY
