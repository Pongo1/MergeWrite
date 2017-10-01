$(document).ready(function(){
	$('#side-bar-toggler').on('click',function(){
        var tog = $(this).attr('data-toggled'); 
        if (tog == 'false'){

            $('.left-nav').css('width','250px');
            $('#app').css('marginLeft','250px');
            $('#side-bar-toggler').attr('data-toggled','true');
        }else{
            $('.left-nav').css('width','0');
            $('#app').css('marginLeft','0');
            $('#side-bar-toggler').attr('data-toggled','false');

        }

    });
    $('#name-arrow').on('click',function(){
        var tog = $(this).attr('data-opened'); 
        if (tog == 'false'){
            $('#profile-options').slideDown(200);
            $('#name-arrow').attr('data-opened','true')

        }else{
            $('#profile-options').slideUp(200);
            $('#name-arrow').attr('data-opened','false')
        }


    });
    $('.gen').on('click',function(){
        var This = $(this);
        document.getElementById("gender-box").value = This.text();
    });

	
});