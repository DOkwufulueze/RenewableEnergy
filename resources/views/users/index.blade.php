@extends('layouts.app')
<link href="{{URL::asset('css/shared.css')}}" rel="stylesheet" type="text/css">
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Users</div>
        <div class="panel-body">
          @if (count($userLocationDistributors) > 0)
            <?php
              $i = 0;
              $colorCodes = ['#dedede', '#efefef'];
            ?>
            <div class="wrapper">
              <div class="data-row" style="width:920px;height:20px;">
                <div class="data-column" style="background: {{$colorCodes[1]}};width: 250px;float:left;">NAME</div>
                <div class="data-column" style="background: {{$colorCodes[1]}};width: 250px;float:left;">EMAIL</div>
                <div class="data-column" style="background: {{$colorCodes[1]}};width: 300px;float:left;">LOCATION / DISTRIBUTOR</div>
              </div>
              @foreach ($userLocationDistributors as $userLocationDistributor)
                <div class="data-row" style="width:920px;height:20px;">
                  <div class="data-column" style="background: {{$colorCodes[$i]}};width: 250px;float:left;">{{ $userLocationDistributor['user']['name'] }}</div>
                  <div class="data-column" style="background: {{$colorCodes[$i]}};width: 250px;float:left;">{{ $userLocationDistributor['user']['email'] }}</div>
                  <div class="data-column" style="background: {{$colorCodes[$i]}};width: 300px;float:left;">{{ $userLocationDistributor['location']['name'] }} / {{ $userLocationDistributor['distributor']['name'] }}</div>
                </div>
                <?php $i = $i % 2 == 0 ? 1 : 0 ?>
              @endforeach
            </div>
          @else
            <div class="wrapper">
              <strong>No User Registered yet</strong>.
            </div>
          @endif
          <div class="line-break"></div>
          <div class="line-break"></div>
          <div class="line-break"></div>
          <div class="links">
            @if (Auth::user())
              @if (Auth::user()->user_type_id == 2)
                <a href="http://localhost:8000">Home</a>
                <a href="http://localhost:8000/devices">Devices</a>
                <a href="http://localhost:8000/devices/create">Create Device</a>
                <a href="http://localhost:8000/usages">Device Usage</a>
                <a href="http://localhost:8000/vectors">Energy Vectors</a>
              @elseif (Auth::user()->user_type_id == 1)
                <a href="http://localhost:8000/vectors">Vectors</a>
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