{{-- THIS IS WHAT HAPPENS ON THE VIEW ADDED DEVICES PAGE --}}
{{--
        THIS PAGE IS CALLED EVERYTIME A USER PRESSES THE ADD BUTTON IN THE POPOVER OF A DEVICE -- IT WILL BE FIXED IN THE DEVICE MODAL SILENTLY
1. Get the device name and its value..
The device name will be normal, but its value is always something like this example..
metaphor => 'blahhhglaahhblahhh:metaphor-mark:blahblahblahblah:metaphor-mark'
Next,
Just pass every device name that the user has added in a swith case for it to return its appearance.
Eg: if device name is 'metaphor', pass it through the switch case and return it with style.....
Next,
get the value of the device the loop is on, and split it with :deviceName-mark: to give the raw text the user put there from the beginning,
Now number them and show to give it some sexy view loool!

The 'lookForMother' function takes a device name as parameter and returns its integer value...
In this program every device has an integer value...
 --}}


@if(Session::has('DeviceBag'))
    <p>Devices that have been used. caspolo
    @foreach (Session::get('DeviceBag')->devices as $device)
        <hr>
        @php
            switch ($device['name']) {
                case 'Metaphor':

                    echo "<h3 class='label label-warning solid-rank'>".$device['name']."</h3><br><br>";
                    break;
                case 'Simile':
                    echo "<h3 class='label label-primary solid-rank'>".$device['name']."</h3><br><br>";
                    break;
                case 'Pun':
                    echo "<h3 class='label label-danger solid-rank'>".$device['name']."</h3><br><br>";
                    break;
                case 'Proverb':
                    echo "<h3 class='label label-default solid-rank' style='background-color: ; color: ;' >".$device['name']."</h3><br><br>";
                    break;
                case 'Alliteration':
                    echo "<h3 class='label label-success solid-rank' style='background-color: ; color: ;' >".$device['name']."</h3><br><br>";
                    break;
                case 'Allegory':
                    echo "<h3 class='label label-warning solid-rank pink-panther' style='background-color: ; color: ;' >".$device['name']."</h3><br><br>";
                    break;
                case 'Euphemism':
                    echo "<h3 class='label label-warning solid-rank ' style='background-color:blue ; color: ;' >".$device['name']."</h3><br><br>";
                    break;
                case 'Foreshadowing':
                    echo "<h3 class='label label-warning solid-rank' style='background-color: cyan; color:black ;' >".$device['name']."</h3><br><br>";
                    break;
                case 'Imagery':
                    echo "<h3 class='label label-warning solid-rank' style='background-color: lime; color: black;' >".$device['name']."</h3><br><br>";
                    break;
                case 'Personification':
                    echo "<h3 class='label label-warning solid-rank' style='background-color: red; color: white;' >".$device['name']."</h3><br><br>";
                    break;
                case 'Epigraph':
                    echo "<h3 class='label label-warning solid-rank' style='background-color: orange; color: black;' >".$device['name']."</h3><br><br>";
                    break;
                case 'Hyperbole':
                    echo "<h3 class='label label-warning solid-rank' style='background-color: black; color: white;' >".$device['name']."</h3><br><br>";
                    break;
                case 'Idiom':
                    echo "<h3 class='label label-warning solid-rank' style='background-color: white; color:black ;' >".$device['name']."</h3><br><br>";
                    break;
                case 'Anecdote':
                    echo "<h3 class='label label-warning solid-rank' style='background-color: lightpink; color: black;' >".$device['name']."</h3><br><br>";
                    break;
                case 'Anthropomorphism':
                    echo "<h3 class='label label-warning solid-rank' style='background-color: green ; color: ;' >".$device['name']."</h3><br><br>";
                    break;
                case 'Antithesis':
                    echo "<h3 class='label label-warning solid-rank' style='background-color: wine ; color: black;' >".$device['name']."</h3><br><br>";
                    break;
                case 'Assonance':
                    echo "<h3 class='label label-warning solid-rank' style='background-color: ash; color: ;' >".$device['name']."</h3><br><br>";
                    break;
                case 'Characterisation':
                    echo "<h3 class='label label-warning solid-rank' style='background-color: purple; color: ;' >".$device['name']."</h3><br><br>";
                    break;
                case 'Euphony':
                    echo "<h3 class='label label-warning solid-rank' style='background-color:gray ; color: ;' >".$device['name']."</h3><br><br>";
                    break;
                case 'Flashback':
                    echo "<h3 class='label label-warning solid-rank' style='background-color:green ; color: ;' >".$device['name']."</h3><br><br>";
                    break;
                case 'Hyperbaton':
                    echo "<h3 class='label label-warning solid-rank' style='background-color: yellow ; color:black ;' >".$device['name']."</h3><br><br>";
                    break;
                default:
                    # code...
                    break;
            }
            $number = 0;
        @endphp
        @foreach ( explode(':'.$device['name'].'-mark'.':', $device['text'] ) as $deviceText)
            @php
                $numberMe = $number +1;
                echo "<p> ".$numberMe.". ".$deviceText." <button type='button' data-device-mother ='".$device['name']."' data-device-motherID='".lookForMother($device['name'])."' data-childID='".$number."' class='btn btn-default btn-xs children'><span class='glyphicon glyphicon-minus'></span></button></p>";
                $number = $number +1;
            @endphp
        @endforeach

    @endforeach
@else
    <p class='text-center'> You have not included any device in your piece. </p>
@endif


@php
    function lookForMother($motherName){
        switch ($motherName) {
            case 'Metaphor':
                return 1;
                break;
            case 'Simile':
                return 2;
                break;
            case 'Pun':
                return 3;
                break;
            case 'Proverb':
                return 4;
                break;
            case 'Alliteration':
                return 5;
                break;
            case 'Allegory':
                return 6;
                break;
            case 'Euphemism':
                return 7;
                break;
            case 'Foreshadowing':
                return 8;
                break;
            case 'Imagery':
                return 9;
                break;
            case 'Personification':
                return 10;
                break;
            case 'Epigraph':
                return 11;
                break;
            case 'Hyperbole':
                return 12;
                break;
            case 'Idiom':
                return 13;
                break;
            case 'Anecdote':
                return 14;
                break;
            case 'Anthropomorphism':
                return 15;
                break;
            case 'Antithesis':
                return 16;
                break;
            case 'Assonance':
                return 17;
                break;
            case 'Characterisation':
                return 18;
                break;
            case 'Euphony':
                return 19;
                break;
            case 'Flashback':
                return 20;
                break;
            case 'Hyperbaton':
                return 21;
                break;

            default:
                break;
        }
    }
@endphp
