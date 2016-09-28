@extends('layouts.app')
<link href="{{URL::asset('css/shared.css')}}" rel="stylesheet" type="text/css">
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Devices</div>
        <div class="panel-body">
          @if (count($devices) > 0)
            <?php
              $i = 0;
              $colorCodes = ['#dedede', '#efefef'];
            ?>
            <div class="wrapper">
              <div class="data-row" style="width:920px;height:20px;">
                <div class="data-column" style="background: {{$colorCodes[1]}}; width: 300px;">NAME</div>
                <div class="data-column" style="background: {{$colorCodes[1]}}; width: 300px;">ENERGY COST PER HOUR</div>
                <div class="data-column" style="background: {{$colorCodes[1]}}; width: 130px;">DEVICE TYPE</div>
                <div class="data-column" style="background: #ffffff; width: 50px;height:20px;"> </div>
                <div class="data-column" style="background: #ffffff; width: 50px;height:20px;"> </div>
              </div>
              @foreach ($devices as $device)
                <div class="data-row" style="width:920px;height:20px;">
                  <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 300px;">{{ $device['name'] }}</div>
                  <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 300px;">{{ $device['energyCostPerHour'] }} Joules</div>
                  <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 130px;">{{ $device['deviceType']->name }}</div>
                  <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 50px;"><a href="/devices/{{$device['id']}}/edit">Edit</a></div>
                  <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 50px;">
                    {{Form::open(['method' => 'DELETE', 'route' => ['devices.destroy', $device['id']]])}}
                      {{Form::submit('Delete', ['class' => 'delete-button', 'style' => 'height:20px;font-size:11px;', 'onmousedown' => 'confirmDelete(this)'])}}
                    {{Form::close()}}
                  </div>
                </div>
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
            <a href="http://localhost:8000/devices/create">Create Device</a>
            <a href="http://localhost:8000/usages">Device Usage</a>
            <a href="http://localhost:8000/vectors">Energy Vectors</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="{{URL::asset('js/devices.js')}}"></script>
@endsection
