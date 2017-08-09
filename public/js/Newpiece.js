$('body').css('display','none');

    //--------------------------------------------------------DOCUMENT READY -------------------------------------------------
 $(document).ready(function(){
    $('body').fadeIn(800);
    $('#meTymNav').animate({fontSize:'25px'},700);

    $('#metaphor-sticker').on('click',function(){
        //TOGGLE DEVICE MARK BOARD WHEN THE METAPHOR BUTTON IS CLICKED
        var devMarkBoard = $('#device-mark-board');
        if(devMarkBoard.attr('data-called-already')=='metaphor-true'){
            $('#device-mark-board').fadeOut(500);
            devMarkBoard.attr('data-called-already','');
        }else{
            $('#device-mark-board').fadeIn(500);
            devMarkBoard.attr('data-called-already','metaphor-true');
            $('#device-mark-title').text($('#metaphor-sticker').text());
        }
    });

    $('#device-add-button').on('click',function(){
        if($('#device-mark-title').text() == $('#metaphor-sticker').text()){
            var metaphorSticker = $('#metaphor-sticker');
            var deviceBox = $('#device-mark-box');
            var oldMetaphors = metaphorSticker.attr('data-metaphor-sticker');
            //check if there are some old metaphors
            if(metaphorSticker.attr('data-metaphor-sticker') ==''){
                metaphorSticker.attr('data-metaphor-sticker',deviceBox.text());
                console.log(metaphorSticker.attr('data-metaphor-sticker'));
            }else{
                    metaphorSticker.attr('data-metaphor-sticker',oldMetaphors + ' :metaphor-mark: '+ deviceBox.val());
                    console.log(metaphorSticker.attr('data-metaphor-sticker'));

            }
        }else{
            alert('Does the button you pressed exist?'+$('#device-mark-title').text());
        }

    });
    $(function(){
        $("[data-toggle='tooltip']").tooltip();
    });
    //USE POPOVERS
    $(function(){
        $("[data-toggle='popover']").popover();
    });


    var addEnglishTip = function(deviceNumber,deviceName){
        $("[data-toggle='popover']").on('shown.bs.popover',function(){
            //$('#' + deviceName + '-box').val($('#' + deviceName + '-sticker').attr('data-'+deviceName +'-sticker'));
            $('#'+deviceName+'-add-button').on('click',function(){
                var deviceSticker = $('#' + deviceName + '-sticker');
                var deviceBox = $('#' + deviceName + '-box');
                if(deviceBox.val() == '' || $('#piece-body').val() == ''){
                    //do nothing
                }else{
                    if(deviceSticker.attr('data-'+deviceName +'-sticker') =='' ){
                        deviceSticker.attr('data-'+deviceName +'-sticker',deviceBox.val());
                        addEnglishTipText(deviceNumber,deviceName,deviceBox.val());
                        console.log(deviceSticker.attr('data-'+deviceName +'-sticker'));
                    }else{
                        var oldDeviceVals = deviceSticker.attr('data-'+deviceName +'-sticker');
                        deviceSticker.attr('data-'+deviceName +'-sticker',oldDeviceVals + ':'+deviceName+'-mark'+':'+deviceBox.val());
                        addEnglishTipText(deviceNumber,deviceName,deviceBox.val());
                        console.log(deviceSticker.attr('data-'+deviceName +'-sticker'));
                    }
                }
            });
        });
    };


    var addEnglishTipText =  function(deviceKey,deviceName,text){
                $.ajax({
                    method: 'get',
                    url: '/add-english-tip/' + deviceKey +'/' + deviceName +'/' + text
                }).done(function(){
                    $('#devicesInUseContent').load('/show-my-devices');
                    $('#saveStatus').fadeTo(600,1,function(){
                        $('#saveStatus').text(deviceName + 'has been added!');
                        setTimeout(function(){
                            $('#saveStatus').fadeTo(600,0.01);
                            $('#saveStatus').text('...');
                        },1000);
                    });
                });
    };


    //addEnglishTipText(2,'Simile','As huge as a ...');



    addEnglishTip(1,'Metaphor');
    addEnglishTip(2,'Simile');
    addEnglishTip(3,'Pun');
    addEnglishTip(4,'Proverb');
    addEnglishTip(5,'Alliteration');
    addEnglishTip(6,'Allegory');
    addEnglishTip(7,'Euphemism');
    addEnglishTip(8,'Foreshadowing');
    addEnglishTip(9,'Imagery');
    addEnglishTip(10,'Personification');
    addEnglishTip(11,'Epigraph');
    addEnglishTip(12,'Hyperbole');
    addEnglishTip(13,'Idiom');
    addEnglishTip(14,'Anecdote');
    addEnglishTip(15,'Anthropomorphism');
    addEnglishTip(16,'Antithesis');
    addEnglishTip(17,'Assonance');
    addEnglishTip(18,'Characterisation');
    addEnglishTip(19,'Euphony');
    addEnglishTip(20,'Flashback');
    addEnglishTip(21,'Hyperbaton');

    $('#searchButton').on('click',function(){
        $.ajax({
                method:'get',
                url: '/save-devices',
            }).done(function(){
                $('#devicesInUseContent').load('/show-my-devices').animate(500);

});
            // var theText = $('#piece-body').val();
            // if(theText.includes('the motherfucker came')){
            //     //$('#showText').text(theText.replace(/the/gi,"<span style='font-size:50px;'>roast</span>"));
            //     $('#showText').addClass('dark-knight');
            //     $('#showText').html(function(){
            //         return theText.replace(/the motherfucker came/gi,"<span style='font-size:30px; border:solid 3px orange; padding:5px; color:green;'>here</span>");
            //     });
            // }else{
            //     console.log('The word doesnst exist');
            // }
    });



});
    //------------------------------------------------------- END OF DOCUMENT READY ---------------------------------------------


    // $(window).bind('beforeunload',function(){
    //     return 'You are leaving this page with some saved data do you still want to leave?';
    // });
setTimeout(function(){
    $('body').fadeIn(600);

},5000);
