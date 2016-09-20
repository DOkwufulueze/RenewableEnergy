@extends('layouts.app')
<link href="{{URL::asset('css/shared.css')}}" rel="stylesheet" type="text/css">
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Device Usages</div>
        <div class="panel-body">
          @if (count($devices) > 0)
            <?php
              $i = 0;
              $colorCodes = ['#dedede', '#efefef'];
            ?>

            <div class="wrapper">
              <div class="data-row" style="width:920px;height:20px;">
                <div class="data-column" style="background:{{$colorCodes[1]}};width:300px">DEVICE</div>
                <div class="data-column" style="background:{{$colorCodes[1]}};width:300px">ENERGY COST / HOUR</div>
                <div class="data-column" style="background:{{$colorCodes[1]}};width:130px;">SWITCH</div>
              </div>
              @foreach ($devices as $device)
                <div class="data-row" style="width:920px;height:20px;margin-bottom:1px;">
                  <div class="data-column" style="background:{{$colorCodes[$i]}};width:300px;">{{ $device['name'] }}</div>
                  <div class="data-column" style="background:{{$colorCodes[$i]}};width:300px;">{{ $device['energyCostPerHour'] }} Joules</div>
                  <div class="data-column" style="cursor:pointer;background:{{ $device['switchStatus'] == '1' ? '#33ee33' : '#ee3333' }};width:130px;color:#ffffff;" onclick="flipSwitch(this, {{$device['id']}})">{{ $device['switchStatus'] == '1' ? 'Switch OFF' : 'Switch ON' }}</div>
                </div>
                <input type="hidden" id="device_{{$device['id']}}" name="device_{{$device['id']}}" value="{{$device['switchStatus']}}">
                <?php $i = $i % 2 == 0 ? 1 : 0 ?>
              @endforeach
            </div>
            @else
              <div class="wrapper">
                <strong>No Device Registered yet</strong>.
              </div>
            @endif
            <div class="line-break"></div>
            <div class="line-break"></div>
            <div class="line-break"></div>
            <div class="links">
              <a href="http://localhost:8000">Home</a>
              <a href="http://localhost:8000/users">Users</a>
              <a href="http://localhost:8000/devices">Devices</a>
              <a href="http://localhost:8000/devices/create">Create New Device</a>
              <a href="http://localhost:8000/vectors">Energy Vectors</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="{{URL::asset('js/usages.js')}}"></script>
@endsection