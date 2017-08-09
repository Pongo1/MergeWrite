<?php

namespace App;

class EnglishDeviceBag
{
    public $devices=[];
    public $deviceNumber =0;


    public function __construct($oldDeviceBag){
        if($oldDeviceBag){
            $this->devices = $oldDeviceBag->devices;
            $this->deviceNumber = $oldDeviceBag->deviceNumber;
        }
    }


    public function addDevice($deviceKey,$deviceName,$copiedText){
        $englishDevice =['name'=>'','text'=>''];
        if($this->devices){
            if(array_key_exists($deviceKey,$this->devices)){
                $englishDevice = $this->devices[$deviceKey];
            }
        }

        //check if the copied text is the same as what is already there
        if($englishDevice['name'] == $deviceName && in_array($copiedText,explode (':'.$deviceName.'-mark'.':',$englishDevice['text'])) || $englishDevice['name'] == $deviceName && $englishDevice['text']==$copiedText ){

        }elseif ($englishDevice['name'] =='' && $englishDevice['text']=='') {
            $englishDevice['name'] = $deviceName;
            $englishDevice['text'] = $copiedText;

        }else{
            $englishDevice['name'] = $deviceName;
            $englishDevice['text'] = $englishDevice['text'].':'.$deviceName.'-mark'.':'.$copiedText;
        }

        $this->devices[$deviceKey] =$englishDevice;
        $this->deviceNumber = count($this->devices);




    }
}
