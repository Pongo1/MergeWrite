$('body').css('display','none');
  $(document).ready(function(){
    $('body').fadeIn(800);
    $('#meTym').animate({fontSize:'100px'},1000);

  });
setTimeout(function(){
  $('body').fadeIn(700);
},1000)



$('#B-down').on('click',function(event){
    event.preventDefault();

    var This = $(this);
    var toggled_value = This.attr('data-toggled');
    if(toggled_value == 'true'){
        $('#piece-board').hide(300);
        This.attr('data-toggled','false');
        console.log(This.attr('data-toggled'));

    }else{
        $('#piece-board').show(300);
        This.attr('data-toggled','true');
        console.log(This.attr('data-toggled'));
    }

    //$('#off').hide(1000);

});
//$('#meTym').animate({left:'50px'},2000);


$('#signIn').animate({left:'280px'},1500);
$('#meTymNav').animate({fontSize:'25px'},700);
$('#signUp').animate({right:'260px'},1500);

$('#loginPane').animate({top:'40px'},1500, function(){


});
$('#makePane').animate({height:'450px'},1000);
$('#seePane').animate({top:'70px'},1300);
$('#regPane').animate({top:'40px'},1500);

$('#allPane').animate({width:'770px'},500);
