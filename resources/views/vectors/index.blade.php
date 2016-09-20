@extends('layouts.app')
<link href="{{URL::asset('css/shared.css')}}" rel="stylesheet" type="text/css">
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Energy Requirement Vectors</div>
        <div class="panel-body">
          @if (count($users) > 0)
            <?php
              $i = 0;
              $colorCodes = ['#dedede', '#efefef'];
            ?>
            <div class="wrapper">
              <div class="data-row">
                <div class="data-column" style="background: {{$colorCodes[1]}}">NAME</div>
                <div class="data-column" style="background: {{$colorCodes[1]}}">ACTION</div>
              </div>
              @foreach ($users as $user)
                <div class="data-row">
                  <div class="data-column" style="background: {{$colorCodes[$i]}}">{{ $user['name'] }}</div>
                  <div class="data-column" style="background: {{$colorCodes[$i]}}"><a href="vectors/user/{{$user->id}}">View Energy Vector</a></div>
                </div>
                <?php $i += 1 ?>
              @endforeach
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
            <a href="http://localhost:8000/usages">Device Usage</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection