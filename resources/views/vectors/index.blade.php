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
            <!-- <div> BY USERS </div> -->
            <div class="wrapper" style="max-height:100px;overflow:auto;">
              <div>
                <div class="data-row">
                  <div class="data-column" style="background: {{$colorCodes[1]}}">NAME</div>
                  <div class="data-column" style="background: {{$colorCodes[1]}}">ACTION</div>
                </div>
                @foreach ($users as $user)
                  <div class="data-row">
                    <div class="data-column" style="background: {{$colorCodes[$i]}}">{{ $user['name'] }}</div>
                    <div class="data-column" style="background: {{$colorCodes[$i]}}"><a href="vectors/user/{{$user['id']}}">View Energy Vector</a></div>
                  </div>
                  <?php $i = $i % 2 == 0 ? 1 : 0 ?>
                @endforeach
              </div>
            </div>

            <!-- <div> BY DISTRIBUTORS </div>
            <div class="wrapper" style="max-height:100px;overflow:auto;">
              <div>
                <div class="data-row">
                  <div class="data-column" style="background: {{$colorCodes[1]}}">NAME</div>
                  <div class="data-column" style="background: {{$colorCodes[1]}}">ACTION</div>
                </div>
                @foreach ($users as $user)
                  <div class="data-row">
                    <div class="data-column" style="background: {{$colorCodes[$i]}}">{{ $user['name'] }}</div>
                    <div class="data-column" style="background: {{$colorCodes[$i]}}"><a href="vectors/user/{{$user['id']}}">View Energy Vector</a></div>
                  </div>
                  <?php $i = $i % 2 == 0 ? 1 : 0 ?>
                @endforeach
              </div>
            </div> -->
          @endif
          <div class="line-break"></div>
          <div class="line-break"></div>
          <div class="line-break"></div>
          <div class="links">
            @if (Auth::user()) 
              @if (Auth::user()->user_type_id == 2)
                <a href="http://localhost:8000">Home</a>
                <a href="http://localhost:8000/users">Users</a>
                <a href="http://localhost:8000/devices">Devices</a>
                <a href="http://localhost:8000/devices/create">Create Device</a>
                <a href="http://localhost:8000/usages">Device Usage</a>
              @elseif (Auth::user()->user_type_id == 1)
                <a href="http://localhost:8000/users">Users</a>
                <a href="http://localhost:8000/admin/locations">Locations</a>
                <a href="http://localhost:8000/admin/distributors">Distributors</a>
                <a href="http://localhost:8000/admin/location-distributors">Location Distributors
              @endif
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection