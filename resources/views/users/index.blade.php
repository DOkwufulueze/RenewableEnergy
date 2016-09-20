@extends('layouts.app')
<link href="{{URL::asset('css/shared.css')}}" rel="stylesheet" type="text/css">
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Users</div>
        <div class="panel-body">
          @if (count($users) > 0)
            <?php
              $i = 0;
              $colorCodes = ['#dedede', '#efefef'];
            ?>
            <div class="data-row">
              <div class="data-column" style="background: {{$colorCodes[1]}}">NAME</div>
              <div class="data-column" style="background: {{$colorCodes[1]}}">EMAIL</div>
            </div>
            @foreach ($users as $user)
              <div class="data-row">
                <div class="data-column" style="background: {{$colorCodes[$i]}}">{{ $user['name'] }}</div>
                <div class="data-column" style="background: {{$colorCodes[$i]}}">{{ $user['email'] }}</div>
              </div>
              <?php $i = $i % 2 == 0 ? 1 : 0 ?>
            @endforeach
          @else
            <div class="wrapper">
              <strong>No User Registered yet</strong>.
            </div>
          @endif
          <div class="line-break"></div>
          <div class="line-break"></div>
          <div class="line-break"></div>
          <div class="links">
            <a href="http://localhost:8000">Home</a>
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