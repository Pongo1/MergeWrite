<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EnglishDeviceBag;
use Session;

class PieceController extends Controller
{
    public function addEnglishTipItem($key, $deviceName, $text){
        $old_bag = Session::has('DeviceBag') ? Session::get('DeviceBag') : null;
        $device_bag = new EnglishDeviceBag($old_bag);
        $device_bag->addDevice($key,$deviceName,$text);
        Session::put('DeviceBag',$device_bag);
        Session::put('devicesExist','Yes');
    }

    public function showDevicesModal(){
        return view('fragments.devicesmodalrefresh');
    }
    public function forSkeletonText(){
        return view('fragments.forskeleton');
    }
    public function temporarySave(Request $request){
        return Session::put('temporaryPiece',['title' => $request->title, 'body' =>$request->body,'skeletal_form' => $request->skeletal_form]);
    }

    public function delDeviceChild($deviceMother,$motherDeviceID, $childID){
        $existingBag = Session::get('DeviceBag');
        $childArray = explode(':'.$deviceMother.'-mark'.':',$existingBag->devices[$motherDeviceID]['text']);
        unset($childArray[$childID]);
        $scraps = '';
        if(count($childArray) > 1){
            foreach ($childArray as $child) {
                if($scraps == ''){
                    $scraps = $child;
                }else{
                    $scraps = $scraps.':'.$deviceMother.'-mark'.':'.$child;
                }
            }
            $existingBag->devices[$motherDeviceID]['text'] = $scraps;

        }elseif (count($childArray) == 1 ) {
            $scraps = $childArray[0];
            $existingBag->devices[$motherDeviceID]['text'] = $scraps;
        }else{
            //delete the mother device itself
            unset($existingBag->devices[$motherDeviceID]);
            $existingBag->deviceNumber = $existingBag->deviceNumber -1;
        }
        Session::put('DeviceBag',$existingBag);
    }


























    public function showSession(){

        //print_r(Session::get('DeviceBag')->devices);
        echo '<br>'; echo '<br>'; echo '<br>'; echo '<br>';

        print_r( Session::all());
         echo '<br>';

        print_r(Session::get('temporaryPiece'));


    }


    public function clearDeviceBag(){
        Session::forget('DeviceBag');
    }


    public function Trial(){
            foreach (Session::get('DeviceBag')->devices as $device) {
                # code...
                print_r($device);
                $theArray =explode(':simile-mark:',$device['text']);
                $key = ' I am like a lion king ';

                echo $device['text'];
                echo '<br>';
                foreach (explode(':simile-mark:',$device['text']) as $value) {
                    if(in_array($key,$theArray)){
                        echo 'Yes I am there!';
                        echo "'".$value."'";
                        echo '<br>';
                    }else{
                        echo 'Nope.. I am not there!';

                        echo "'".$value."'";
                        echo '<br>';
                    }

                }

                //print_r(Session::get('DeviceBag')->devices[0]);
            }

    }


    public function devicesInUse(){
        return view('fragments.inuse');
    }
}
