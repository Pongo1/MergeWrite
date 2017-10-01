$('body').css('display','none');

  $(document).ready(function(){

      $('[data-toggle="tooltip"]').tooltip();
      $('body').fadeIn(400);
      $('#meTymNav').animate({fontSize:'25px'},700);

      $('.done-button').on('click',function(){
          var This = $(this);
          var invID = $(this).attr('data-ID');
          $.ajax({
              method:'get',
              url: '/mentor-done/'+invID
          }).done(function(){
             This.css('font-size','1');
             This.text('Marked')
             This.animate({fontSize:'15px'},300);

          });
      });

      setTimeout(function () {
          $('#first-board').fadeTo(500,1,function(){
             $('#second-board').fadeTo(500,1);
          });
      }, 500);

      $('.delete-button').on('click',function(){
          var This = $(this);
          var invID = $(this).attr('data-ID');
          $.ajax({
              method:'get',
              url: '/mentor-del/'+invID
          }).done(function(){
             $('#whole-'+invID).fadeOut(500);

          });
      });
  });//END OF DOCUMENT READY
