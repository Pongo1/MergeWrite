$('body').css('display','none');
    $(document).ready(function(){
            $('body').fadeIn(800);
            $('#meTymNav').animate({fontSize:'25px'},700);


            $('#profile-button').on('click',function(){
                var This = $(this);
                var toggled_value = This.attr('data-toggled');
                if(toggled_value == 'true'){
                    $('#profile-edit').show(600,function(){
                        This.attr('data-toggled','false');
                    });
                }else{
                    $('#profile-edit').hide(600,function(){
                        This.attr('data-toggled','true');
                    });

                }
            });

            var selectPic = function(ID,path){
                var This = $(ID);
                This.css('border-color','maroon');
                This.css('border-width','5px');
                This.css('border-radius','15px');
                document.getElementById('picture_path').value = path;
            }

            var resetOthers = function(first,second){
                $(first).css('border-radius','0px');
                $(first).css('border-color','black');
                $(first).css('border-width','2px');
                $(second).css('border-radius','0px');
                $(second).css('border-color','black');
                $(second).css('border-width','2px');
            }
            $('.picture1').on('click',function(event){
                event.preventDefault();
                selectPic('.picture1','imgs/avartar-samurai.svg');
                resetOthers('.picture2','.picture3');
            });

            $('.picture2').on('click',function(event){
                event.preventDefault();
                selectPic('.picture2','imgs/avatar-black.png');
                resetOthers('.picture1','.picture3');

            });
            $('.picture3').on('click',function(event){
                event.preventDefault();
                selectPic('.picture3','imgs/chick-samurai-avatar.png');
                resetOthers('.picture2','.picture1');
            });

    });
