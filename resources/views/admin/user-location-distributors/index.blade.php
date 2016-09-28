@extends('layouts.app')
<link href="{{URL::asset('css/shared.css')}}" rel="stylesheet" type="text/css">
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">User Location Distributors</div>
        <div class="panel-body">
          @if (count($userLocationDistributors) > 0)
            <?php
              $i = 0;
              $colorCodes = ['#dedede', '#efefef'];
            ?>
            <div class="wrapper">
              <div class="data-row" style="width:920px;height:20px;">
                <div class="data-column" style="background: {{$colorCodes[1]}}; width: 300px;float:left;">USER</div>
                <div class="data-column" style="background: {{$colorCodes[1]}}; width: 250px;float:left;">LOCATION</div>
                <div class="data-column" style="background: {{$colorCodes[1]}}; width: 250px;float:left;">DISTRIBUTOR</div>
                <div class="data-column" style="background: #ffffff; width: 50px;float:left;"> </div>
              </div>
              @foreach ($userLocationDistributors as $userLocationDistributor)
                <div class="data-row" style="width:920px;height:20px;">
                  <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 300px;float:left;">{{ $userLocationDistributor['user']['name'] }}</div>
                  <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 250px;float:left;">{{ $userLocationDistributor['location']['name'] }}</div>
                  <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 250px;float:left;">{{ $userLocationDistributor['distributor']['name'] }}</div>
                  <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 50px;float:left;"><a href="user-location-distributors/{{$userLocationDistributor['id']}}/edit">Edit</a></div>
                </div>
                <?php $i = $i % 2 == 0 ? 1 : 0 ?>
              @endforeach
            </div>
          @else
            <div class="wrapper">
              <strong>No Location Distributor Registered yet</strong>.
            </div>
          @endif
          <div class="line-break"></div>
          <div class="line-break"></div>
          <div class="line-break"></div>
          <div class="links">
            <a href="http://localhost:8000/users">Users</a> &middot;
            <a href="http://localhost:8000/vectors">Vectors</a> &middot;
            <a href="http://localhost:8000/admin/locations">Locations</a> &middot;
            <a href="http://localhost:8000/admin/distributors">Distributors</a> &middot;
            <a href="http://localhost:8000/admin/location-distributors/create">New Location Distributor</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
