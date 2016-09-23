@extends('layouts.app')
<link href="{{URL::asset('css/shared.css')}}" rel="stylesheet" type="text/css">
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Energy Requirement Vector for {{$user->name}}</div>
        <div class="panel-body">
          @if (count($userVectors) > 0)
            <?php
              $i = 0;
              $colorCodes = ['#dedede', '#efefef'];
            ?>
            <div class="wrapper">
              @foreach ($userVectors as $key => $value) <!-- // 0: [deviceId: [0...23]] -->
                <div class="data-row" style="width:2750px;height:20px;">
                  <div class="data-column" style="background: {{$colorCodes[1]}}">{{$key}}</div>
                </div>
                <div class="data-row" style="width:2750px;height:20px;margin-top:1px;">
                  <div class="data-column" style="background: {{$colorCodes[1]}};width:100px;">Device</div>
                  <?php for ($k=1; $k <= 24; $k++) { ?>
                    <div class="data-column" style="background: {{$colorCodes[1]}};width:100px;">Hours ({{$k}})</div>
                  <?php } ?>
                </div>
                @foreach ($value as $key2 => $value2) <!-- // deviceId: [0...23] -->
                  <div class="data-row" style="width:2750px;height:20px;margin-top:1px;">
                  @foreach ($value2 as $key3 => $value3) <!-- // 0: [0: energy Requirement] -->
                  
                    @foreach ($value3 as $key4 => $value4) <!-- // 0: energy Requirement -->
                      @foreach ($value4 as $key5 => $value5) <!-- // energy Requirement -->
                        <div class="data-column" style="background: {{$colorCodes[$i]}};width:100px;">{{$value5}}</div>
                      @endforeach
                    @endforeach
                  </div>
                  @endforeach
                @endforeach
                <?php $i = $i % 2 == 0 ? 1 : 0 ?>
                <div class="line-break"></div>
              @endforeach
            </div>
          @endif
          <div class="line-break"></div>
          <div class="line-break"></div>
          <div class="line-break"></div>
          <div class="links">
            <a href="http://localhost:8000/devices">Devices</a>
            <a href="http://localhost:8000/devices/create">Create New Device</a>
            <a href="http://localhost:8000/usages">Device Usage</a>
            <a href="http://localhost:8000/vectors">Energy Vectors</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection