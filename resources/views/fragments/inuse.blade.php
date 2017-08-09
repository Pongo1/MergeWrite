@if(Session::has('DeviceBag'))
    <button type='button' class='btn btn-default dropdown-toggle' style='width:100%; color:white; background-color:maroon;' id='devicesInUse' data-toggle='dropdown' ><span class='badge'>{{Session::get('DeviceBag')->deviceNumber}}</span> Devices in use <span class='caret'></span></button>
    <ul class='dropdown-menu' role='menu' style='width:100%' aria-labelledby="devicesInUse">
        <li role='presentation' class='dropdown-header'>Devices indicated</li>
        <li role='presentation' class='divider'></li>
        @foreach (Session::get('DeviceBag')->devices as $device)
            <li role='presentation'><a style='cursor: pointer;' role='menuitem' data-toggle='tooltip' data-placement='right' title='{{$device['name']."s you have indicated."}}'>{{$device['name']}} <span class='badge'>{{count(explode(':'.$device['name'].'-mark'.':',$device['text']))}}</span></a></li>
        @endforeach
    </ul>
@endif
