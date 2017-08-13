$('body').css('display','none');

  $(document).ready(function(){

      $('[data-toggle="tooltip"]').tooltip();
        $('body').fadeIn(800);
        $('#meTymNav').animate({fontSize:'25px'},700);

        $('#fullview-skeleton-page').html(function(){
            return $('#fullview-skeleton-container').val();
        });


        $('.like-button').on('click',function(){
            var piece_id = $(this).attr('data-piece-id');
            $.ajax({
                method:'get',
                url:'/like/'+piece_id

            }).done(function(){
                $('#likes-and-coins-'+piece_id).load('/refresh-likes/'+piece_id).hide().fadeIn(300);
            });
        });
        // post button is clicked
        $('#post').on('click',function(){
            var comment = $('#comment').val();
            var piece_id = document.getElementById('piece-id').value;
            $.ajax({
                method:'get',
                url:makeCommentUrl,
                data:{piece_id:piece_id, comment:comment }
            }).done(function(){
                $('#comment-box').load('/refresh-comments/'+piece_id).hide().fadeIn(400,function(){
                    $('#post-badge').text($('#number-of-comments').text());
                    $('#comment').val('');
                })
            });
        });

        $('.piece-modal-button').on('click',function(event){
            var This = $(this);
            var pieceID = This.attr('data-piece-postID');
            var begPieceContent = 'piece-post-skeleton-data-';
            var begPiecePage = 'piece-post-skeleton-page-';
            $('#'+begPiecePage+ pieceID).html(function(){
                return $('#'+begPieceContent+pieceID).val();
            });
        });

        $('#comment-button').on('click',function(event){
            event.preventDefault();
            var This= $(this);
            var toggled_value = This.attr('data-toggled');
            if(toggled_value == 'false'){
                $('#comment-on-box').fadeIn(400,function(){
                    $('#all-comments-box').fadeIn(400);
                    This.attr('data-toggled','true');
                    console.log(This.attr('data-toggled'));
                });
            }else{
                $('#all-comments-box').fadeOut(400,function(){
                    $('#comment-on-box').fadeOut(400);
                    This.attr('data-toggled','false');
                    console.log(This.attr('data-toggled'));
                });
            }
        });


    });
//END OF DOCUMENT READY

setTimeout(function(){
  $('body').fadeIn(700);
},1000)


//--------------------_SCROLL EFFECT ----------------------------
$(window).on("load",function(){
    $(window).scroll(function(){
        var windowBottom = $(this).scrollTop() + $(this).innerHeight();
        $(".piece-post").each(function(){

            var objectBottom = $(this).offset().top + $(this).outerHeight();

            if(objectBottom < windowBottom){
                if($(this).css("opacity")==0.3){
                    $(this).fadeTo(500,1);
                }
            }else{
                if($(this).css("opacity") == 1){
                    $(this).fadeTo(500,0.3);
                }
            }
        });

    }).scroll();
});
//------------------------------------------------------ END OF SCROLL EFFECT-----------------------------------------
