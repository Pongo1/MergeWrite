@php
    $deviceMotherValues ='';
    $deviceMotherText = '';

    foreach (Session::get('DeviceBag')->devices as $mother => $text) {
        if($deviceMotherValues ==''){
            $deviceMotherValues = $deviceMotherValues.(string)$text['name'];
            $deviceMotherText = $deviceMotherText.$text['text'] ;
        }else{
            $deviceMotherValues = $deviceMotherValues.'<--->'.(string)$text['name'];
            $deviceMotherText = $deviceMotherText.'<--->'.$text['text'];
        }
    }
    echo "<input class='form-control' style='display:none'  value='".$deviceMotherValues."' id='deviceMotherNames' type='text'>";
    echo "<textarea class='form-control' style='display:none' id='deviceTextClosed'>".$deviceMotherText."</textarea>";

@endphp
