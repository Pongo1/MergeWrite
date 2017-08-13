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
            $('#devicesInUseContent').load('/show-my-devices').hide().fadeIn(600);
            $('#modal-body').load('/refresh-devices-view').hide().fadeIn(600);
            $("#forSkeletonView").load('/load-for-skeleton-pane');
            $('#saveStatus').fadeTo(600,1,function(){
                $('#saveStatus').text(deviceName + 'has been added!');
                setTimeout(function(){
                    $('#saveStatus').fadeTo(600,0.01);
                    $('#saveStatus').text('...');
                },1000);
            });
        });
    };

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

    var returnDeviceTextWithStyle = function(deviceName,impureTextToStyle,wholeText,placenta){
        //deviceName is obvious
        //impureTextToStyle will be a text that is separated with <-------> and :devicename:
        //So impureTextToStyle will be split with <---> and further split with :devicename: to get rich pure text
        //placenta will be the corresponding index of the list of deviceNames and the device Content
        switch (deviceName) {
            case 'Metaphor':
                for (pureTextToStyle of impureTextToStyle.split('<--->')[placenta].split(':'+deviceName+'-mark'+':')) {
                    wholeText = wholeText.replace(RegExp(pureTextToStyle,'g'),"<br><div><span class='label label-warning solid-two-light'>Metaphor</span><span        class='dark-knight solid-text-light' style='font-size:15px;'><b>------></b></span><span class='dark-knight label label-warning solid-two-light' style = ' color: black; padding:5px; border: solid 2px black;'> "+pureTextToStyle+"</span></div>");
                }
                return wholeText;
                break;
            case 'Simile':
                for (pureTextToStyle of impureTextToStyle.split('<--->')[placenta].split(':'+deviceName+'-mark'+':')) {
                    wholeText = wholeText.replace(RegExp(pureTextToStyle,'g'),"<br><div><span class='label label-primary solid-two-light'>Simile</span><span class='dark-knight solid-text-light' style='font-size:15px;'><b>------></b></span><span class='dark-knight label label-info solid-two-light' style = ' padding:5px; border: solid 2px black; color:white;'> "+pureTextToStyle+"</span></div>");
                }
                return wholeText;
                break;
            case 'Pun':
                for (pureTextToStyle of impureTextToStyle.split('<--->')[placenta].split(':'+deviceName+'-mark'+':')) {
                    wholeText = wholeText.replace(RegExp(pureTextToStyle,'g'),"<br><div><span class='label label-danger solid-two-light'>Pun</span><span class='dark-knight solid-text-light' style='font-size:15px;'><b>------></b></span><span class='dark-knight label label-danger solid-two-light' style = ' padding:5px;color:white; border: solid 2px black;'> "+pureTextToStyle+"</span></div>");
                }
                return wholeText;
                break;
            case 'Proverb':
                for (pureTextToStyle of impureTextToStyle.split('<--->')[placenta].split(':'+deviceName+'-mark'+':')) {
                    wholeText = wholeText.replace(RegExp(pureTextToStyle,'g'),"<br><div><span class='label label-default solid-two-light'>Proverb</span><span class='dark-knight solid-text-light' style='font-size:15px;'><b>------></b></span><span class='dark-knight label label-default solid-two-light' style = 'border-radius:10%; padding:5px; color:white ; border: solid 2px black;'> "+pureTextToStyle+"</span></div>");
                }
                return wholeText;
                break;
            case 'Alliteration':
                for (pureTextToStyle of impureTextToStyle.split('<--->')[placenta].split(':'+deviceName+'-mark'+':')) {
                    wholeText = wholeText.replace(RegExp(pureTextToStyle,'g'),"<br><div><span class='label label-success solid-two-light'>Alliteration</span><span class='dark-knight solid-text-light' style='font-size:15px;'><b>------></b></span><span class='dark-knight solid-two-light label label success' style = 'border-radius:10%; padding:5px; border: solid 2px black;'> "+pureTextToStyle+"</span></div>");
                }
                return wholeText;
                break;
            case 'Allegory':
                for (pureTextToStyle of impureTextToStyle.split('<--->')[placenta].split(':'+deviceName+'-mark'+':')) {
                    wholeText = wholeText.replace(RegExp(pureTextToStyle,'g'),"<br><div><span class='label label-danger solid-two-light' style='background-color: deeppink; color:white;'>Allegory</span><span class='dark-knight solid-text-light' style='font-size:15px;'><b>------></b></span><span class='dark-knight solid-two-light' style = 'background-color: deeppink;color:white; border-radius:10%; padding:5px; border: solid 2px black;'> "+pureTextToStyle+"</span></div>");
                }
                return wholeText;
                break;
            case 'Euphemism':
                for (pureTextToStyle of impureTextToStyle.split('<--->')[placenta].split(':'+deviceName+'-mark'+':')) {
                    wholeText = wholeText.replace(RegExp(pureTextToStyle,'g'),"<br><div><span class='label label-danger solid-two-light' style='background-color: blue; color:white;'>Euphemism</span><span class='dark-knight solid-text-light' style='font-size:15px;'><b>------></b></span><span class='dark-knight solid-two-light' style = 'background-color: blue; color:white; border-radius:10%; padding:5px; border: solid 2px black;'> "+pureTextToStyle+"</span></div>");
                }
                return wholeText;
                break;
            case 'Foreshadowing':
                for (pureTextToStyle of impureTextToStyle.split('<--->')[placenta].split(':'+deviceName+'-mark'+':')) {
                    wholeText = wholeText.replace(RegExp(pureTextToStyle,'g'),"<br><div><span class='label label-danger solid-two-light' style='background-color: cyan; color:black;'>Foreshadowing</span><span class='dark-knight solid-text-light' style='font-size:15px;'><b>------></b></span><span class='dark-knight solid-two-light' style = 'background-color: cyan; padding:5px; border-radius:10%; border: solid 2px black;'> "+pureTextToStyle+"</span></div>");
                }
                return wholeText;
                break;
            case 'Imagery':
                for (pureTextToStyle of impureTextToStyle.split('<--->')[placenta].split(':'+deviceName+'-mark'+':')) {
                    wholeText = wholeText.replace(RegExp(pureTextToStyle,'g'),"<br><div><span class='label label-danger solid-two-light' style='background-color: lime; color:black;'>Imagery</span><span class='dark-knight solid-text-light' style='font-size:15px;'><b>------></b></span><span class='dark-knight solid-two-light' style = 'background-color: lime;border-radius:10%; padding:5px; border: solid 2px black;'> "+pureTextToStyle+"</span></div>");
                }
                return wholeText;
                break;
            case 'Personification':
                for (pureTextToStyle of impureTextToStyle.split('<--->')[placenta].split(':'+deviceName+'-mark'+':')) {
                    wholeText = wholeText.replace(RegExp(pureTextToStyle,'g'),"<br><div><span class='label label-danger solid-two-light' style='background-color: red; color:white;'>Personification</span><span class='dark-knight solid-text-light' style='font-size:15px;'><b>------></b></span><span class='dark-knight solid-two-light' style = 'background-color: red; color:white; border-radius:10%; padding:5px; border: solid 2px black;'> "+pureTextToStyle+"</span></div>");
                }
                return wholeText;
                break;
            case 'Epigraph':
                for (pureTextToStyle of impureTextToStyle.split('<--->')[placenta].split(':'+deviceName+'-mark'+':')) {
                    wholeText = wholeText.replace(RegExp(pureTextToStyle,'g'),"<br><div><span class='label label-danger solid-two-light' style='background-color: orange; color:black;'>Epigraph</span><span class='dark-knight solid-text-light' style='font-size:15px;'><b>------></b></span><span class='dark-knight solid-two-light' style = 'background-color: orange; border-radius:10%; padding:5px; border: solid 2px black;'> "+pureTextToStyle+"</span></div>");
                }
                return wholeText;
                break;
            case 'Hyperbole':
                for (pureTextToStyle of impureTextToStyle.split('<--->')[placenta].split(':'+deviceName+'-mark'+':')) {
                    wholeText = wholeText.replace(RegExp(pureTextToStyle,'g'),"<br><div><span class='label label-danger solid-two-light' style='background-color: black; color:white;'>Hyperbole</span><span class='dark-knight solid-text-light' style='font-size:15px;'><b>------></b></span><span class='dark-knight solid-two-light' style = 'background-color: black; color:white; border-radius:10%;padding:5px; border: solid 2px black;'> "+pureTextToStyle+"</span></div>");
                }
                return wholeText;
                break;
            case 'Idiom':
                for (pureTextToStyle of impureTextToStyle.split('<--->')[placenta].split(':'+deviceName+'-mark'+':')) {
                    wholeText = wholeText.replace(RegExp(pureTextToStyle,'g'),"<br><div><span class='label label-danger solid-two-light' style='background-color: white; color:black;'>Idiom</span><span class='dark-knight solid-text-light' style='font-size:15px;'><b>------></b></span><span class='dark-knight solid-two-light' style = 'background-color: white; border-radius:10%; padding:5px; border: solid 2px black;'> "+pureTextToStyle+"</span></div>");
                }
                return wholeText;
                break;
            case 'Anecdote':
                for (pureTextToStyle of impureTextToStyle.split('<--->')[placenta].split(':'+deviceName+'-mark'+':')) {
                    wholeText = wholeText.replace(RegExp(pureTextToStyle,'g'),"<br><div><span class='label label-danger solid-two-light' style='background-color: lightpink; color:black;'>Anecdote</span><span class='dark-knight solid-text-light' style='font-size:15px;'><b>------></b></span><span class='dark-knight solid-two-light' style = 'background-color: lightpink;border-radius:10%; padding:5px; border: solid 2px black;'> "+pureTextToStyle+"</span></div>");
                }
                return wholeText;
                break;
            case 'Anthropomorphism':
                for (pureTextToStyle of impureTextToStyle.split('<--->')[placenta].split(':'+deviceName+'-mark'+':')) {
                    wholeText = wholeText.replace(RegExp(pureTextToStyle,'g'),"<br><div><span class='label label-danger solid-two-light' style='background-color: brown; color:white;'>Anthropomorphism</span><span class='dark-knight solid-text-light' style='font-size:15px;'><b>------></b></span><span class='dark-knight solid-two-light' style = 'background-color: brown; color:white; border-radius:10%; padding:5px; border: solid 2px black;'> "+pureTextToStyle+"</span></div>");
                }
                return wholeText;
                break;
            case 'Antithesis':
                for (pureTextToStyle of impureTextToStyle.split('<--->')[placenta].split(':'+deviceName+'-mark'+':')) {
                    wholeText = wholeText.replace(RegExp(pureTextToStyle,'g'),"<br><div><span class='label label-danger solid-two-light' style='background-color: wine; color:white;'>Antithesis</span><span class='dark-knight solid-text-light' style='font-size:15px;'><b>------></b></span><span class='dark-knight solid-two-light' style = 'background-color: wine; color:black;border-radius:10%; padding:5px; border: solid 2px black;'> "+pureTextToStyle+"</span></div>");
                }
                return wholeText;
                break;
            case 'Assonance':
                for (pureTextToStyle of impureTextToStyle.split('<--->')[placenta].split(':'+deviceName+'-mark'+':')) {
                    wholeText = wholeText.replace(RegExp(pureTextToStyle,'g'),"<br><div><span class='label label-danger solid-two-light' style='background-color: ash; color:white;'>Assonance</span><span class='dark-knight solid-text-light' style='font-size:15px;'><b>------></b></span><span class='dark-knight solid-two-light' style = 'background-color: ash; color:white; border-radius:10%; padding:5px; border: solid 2px black;'> "+pureTextToStyle+"</span></div>");
                }
                return wholeText;
                break;
            case 'Characterisation':
                for (pureTextToStyle of impureTextToStyle.split('<--->')[placenta].split(':'+deviceName+'-mark'+':')) {
                    wholeText = wholeText.replace(RegExp(pureTextToStyle,'g'),"<br><div><span class='label label-danger solid-two-light' style='background-color: purple; color:white;'>Characterisation</span><span class='dark-knight solid-text-light' style='font-size:15px;'><b>------></b></span><span class='dark-knight solid-two-light' style = 'background-color: purple; color:white; border-radius:10%; padding:5px; border: solid 2px black;'> "+pureTextToStyle+"</span></div>");
                }
                return wholeText;
                break;
            case 'Euphony':
                for (pureTextToStyle of impureTextToStyle.split('<--->')[placenta].split(':'+deviceName+'-mark'+':')) {
                    wholeText = wholeText.replace(RegExp(pureTextToStyle,'g'),"<br><div><span class='label label-danger solid-two-light' style='background-color: gray; color:white;'>Euphony</span><span class='dark-knight solid-text-light' style='font-size:15px;'><b>------></b></span><span class='dark-knight solid-two-light' style = 'background-color: gray; color:white; padding:5px; border: solid 2px black; border-radius:10%;'> "+pureTextToStyle+"</span></div>");
                }
                return wholeText;
                break;
            case 'Flashback':
                for (pureTextToStyle of impureTextToStyle.split('<--->')[placenta].split(':'+deviceName+'-mark'+':')) {
                    wholeText = wholeText.replace(RegExp(pureTextToStyle,'g'),"<br><div><span class='label label-danger solid-two-light' style='background-color: green; color:white;'>Flashback</span><span class='dark-knight solid-text-light' style='font-size:15px;'><b>------></b></span><span class='dark-knight solid-two-light' style = 'background-color: green; padding:5px;  color:white; border: solid 2px black; border-radius:10%;'> "+pureTextToStyle+"</span></div>");
                }
                return wholeText;
                break;

            case 'Hyperbaton':
                for (pureTextToStyle of impureTextToStyle.split('<--->')[placenta].split(':'+deviceName+'-mark'+':')) {
                    wholeText = wholeText.replace(RegExp(pureTextToStyle,'g'),"<br><div><span class='label label-danger solid-two-light' style='background-color: yellow; color:black;'>Hyperbaton</span><span class='dark-knight solid-text-light' style='font-size:15px;'><b>------></b></span><span class='dark-knight solid-two-light' style = 'background-color: yellow; padding:5px; border: solid 2px black; border-radius:10%;'> "+pureTextToStyle+"</span></div>");
                }
                return wholeText;
                break;

            default:
        }
    };

    $('.children').on('click',function(event){
        event.preventDefault();
        var This = $(this);
        var deviceName =This.attr('data-device-mother');
        var deviceMotherID =This.attr('data-device-motherID');
        var deviceChildID =  This.attr('data-childID');

        $.ajax({method:'get',url:'/delete-device-child/'+deviceName+'/'+deviceMotherID+'/'+deviceChildID
            }).done(function(){
                $('#modal-body').load('/refresh-devices-view').hide().fadeIn(600);
                $('#devicesInUseContent').load('/show-my-devices');
                $("#forSkeletonView").load('/load-for-skeleton-pane');
            });
    });

    $('#skeleton-button').on('click',function(){
        var randomText = $('#piece-body').val();
        document.getElementById('piece-title').value == '' ? $('#skeleton-title').text('No title') : $('#skeleton-title').text(document.getElementById('piece-title').value);
        var motherList = document.getElementById('deviceMotherNames').value;
        var motherValues = $('#deviceTextClosed').val();
        var count = 0;
        for (devName of motherList.split('<--->')) {
                randomText = returnDeviceTextWithStyle(devName,motherValues,randomText,count)
                count ++;
        }
            $('#skeleton-body').html(function(){
                return randomText;
            });
    });


    setInterval(function () {
        //update an invisible textbox with the skeletal form of your text
        var randomText = $('#piece-body').val();
        var motherList = document.getElementById('deviceMotherNames').value;
        var motherValues = $('#deviceTextClosed').val();
        var count = 0;
        for (devName of motherList.split('<--->')) {
                randomText = returnDeviceTextWithStyle(devName,motherValues,randomText,count)
                count ++;
        }
        $('#piece-skeletal-form').val(randomText);
        $('#mother-values-sending').val($('#deviceTextClosed').val());
        $('#mother-names-sending').val($('#deviceMotherNames').val());
    }, 5000);

    setInterval(function () {
        $.ajax({method:'get',
            url:'/temporary-piece-save',
            data:{_token: token, body:$('#piece-body').val(),skeletal_form:$('#piece-skeletal-form').val(),title:document.getElementById("piece-title").value }
        }).done(function(){
            $("#temporarilySaved").fadeIn(700,function(){
                setTimeout(function () {
                    $("#temporarilySaved").fadeOut(700);
                }, 3000);
            });
        });
    }, 30000);

});
    //--------------------------------------------------- END OF DOCUMENT READY ---------------------------------------------

setTimeout(function(){
    $('body').fadeIn(600);

},10000);
