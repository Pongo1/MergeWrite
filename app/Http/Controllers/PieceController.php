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
























    public function showSession(){

        print_r(Session::get('DeviceBag')->devices);
            // $devBag = Session::has('deviceBag') ? Session::get('deviceBag') : null;
            // $engDeviceBag = new EnglishDeviceBag($devBag);
            // $engDeviceBag->addDevice(1,'metaphor','A lion in disguise');
            // Session::put('deviceBag',$engDeviceBag);
            // print_r( Session::get('deviceBag'));
            // echo '<br>';
            // echo '<br>';
            // echo '<br>';
            // $dv =Session::get('deviceBag')->devices;
            // print_r(Session::get('deviceBag')->devices);

    }


    public function clearDeviceBag(){
        Session::forget('DeviceBag');
    }


    public function Trial(){

            // if(in_array('seventeen',['shit','gbonatuin','seventeen','fuck'])){
            //     echo 'match found';
            // }else{
            //     echo 'match not found';
            // }
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
