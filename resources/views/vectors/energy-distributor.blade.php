@extends('layouts.app')
<link href="{{URL::asset('css/shared.css')}}" rel="stylesheet" type="text/css">
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Energy Requirement Vector for {{$energyDistributor}}</div>
        <div class="panel-body">
          @if (count($energyDistributorVectors) > 0)
            <?php
              $i = 0;
              $colorCodes = ['#dedede', '#efefef'];
            ?>
            <div>Raw Vector Data</div>
            <div class="wrapper" style="height:200px;">
              <div>
                <div class="data-row" style="width:{{250 + count($usersArray[0]) * 600}}px;height:20px;margin-top:1px;">
                  <div class="data-column" style="background: {{$colorCodes[1]}};width:100px;">Hour</div>
                  <div class="data-column" style="background: {{$colorCodes[1]}};width:100px;">Supplied Energy</div>
                  <div class="data-column" style="width:30px;"> </div>
                  @foreach ($usersArray[0] as $user)
                    <div class="data-column" style="background: {{$colorCodes[1]}};width:300px;"> User Name </div>
                    <div class="data-column" style="background: {{$colorCodes[1]}};width:120px;"> Shiftable Energy </div>
                    <div class="data-column" style="background: {{$colorCodes[1]}};width:120px;"> Unshiftable Energy </div>
                    <div class="data-column" style="width:30px;"> </div>
                  @endforeach
                </div>
                @foreach ($energyCostsArray as $energyCost) <!-- // 0: [deviceId: [0...23]] -->
                  <div class="data-row" style="width:{{250 + count($usersArray[0]) * 600}}px;height:20px;margin-top:1px;">
                    <div class="data-column" style="background: {{$colorCodes[$i]}};width:100px;"> {{$energyCost['hour'] + 1}} </div>
                    <div class="data-column" style="background: {{$colorCodes[$i]}};width:100px;"> {{$energyCost['scheduledEnergyForSupply']}} J </div>
                    <div class="data-column" style="width:30px;"> </div>
                    @foreach ($energyCost['usersArray'][$energyCost['hour']] as $user)
                      <div class="data-column" style="background: {{$colorCodes[$i]}};width:300px;"> {{$user['name']}} </div>
                      <div class="data-column" style="background: {{$colorCodes[$i]}};width:120px;"> {{$user['shiftableEnergy']}} J </div>
                      <div class="data-column" style="background: {{$colorCodes[$i]}};width:120px;"> {{$user['unshiftableEnergy']}} J </div>
                      <div class="data-column" style="width:30px;"> </div>
                    @endforeach
                  </div>
                  <?php $i = $i % 2 == 0 ? 1 : 0 ?>
                @endforeach
              </div>
            </div>

            <div>Aggregate Vector Data</div>
            <div class="wrapper" style="height:200px;">
              <div>
                <div class="data-row" style="width:1450px;height:20px;margin-top:1px;">
                  <div class="data-column" style="background: {{$colorCodes[1]}};width:100px;">Hour</div>
                  <div class="data-column" style="background: {{$colorCodes[1]}};width:100px;font-size:11px;">Scheduled Energy</div>
                  <div class="data-column" style="background: {{$colorCodes[1]}};width:120px;"> Unshiftable Energy </div>
                  <div class="data-column" style="background: {{$colorCodes[1]}};width:120px;font-size:11px;"> Initial Shiftable Energy </div>
                  <div class="data-column" style="background: {{$colorCodes[1]}};width:120px;font-size:11px;"> Total Shiftable Energy </div>
                  <div class="data-column" style="background: {{$colorCodes[1]}};width:120px;font-size:11px;"> Energy Requirement </div>
                  <div class="data-column" style="background: {{$colorCodes[1]}};width:120px;"> Energy Used </div>
                  <div class="data-column" style="background: {{$colorCodes[1]}};width:120px;"> Carried Over Energy </div>
                  <div class="data-column" style="background: {{$colorCodes[1]}};width:420px;"> Remark </div>
                </div>
                @foreach ($energyDistributorVectors as $vector) <!-- // 0: [deviceId: [0...23]] -->
                  <div class="data-row" style="width:1450px;height:20px;margin-top:1px;">
                    <div class="data-column" style="background: {{$colorCodes[$i]}};width:100px;">{{$vector['hour'] + 1}}</div>
                    <div class="data-column" style="background: {{$colorCodes[$i]}};width:100px;">{{$vector['scheduledEnergyForSupply']}} J</div>
                    <div class="data-column" style="background: {{$colorCodes[$i]}};width:120px;"> {{$vector['totalUnshiftableEnergy']}} J </div>
                    <div class="data-column" style="background: {{$colorCodes[$i]}};width:120px;"> {{$vector['initialShiftableEnergy']}} J </div>
                    <div class="data-column" style="background: {{$colorCodes[$i]}};width:120px;"> {{$vector['totalShiftableEnergy']}} J </div>
                    <div class="data-column" style="background: {{$colorCodes[$i]}};width:120px;"> {{$vector['totalEnergyRequirement']}} J </div>
                    <div class="data-column" style="background: {{$colorCodes[$i]}};width:120px;"> {{$vector['totalEnergyUsed']}} J </div>
                    <div class="data-column" style="background: {{$colorCodes[$i]}};width:120px;"> {{$vector['carriedOverEnergy']}} J </div>
                    <div class="data-column" style="background: {{$vector['colorCode']}};color:{{$vector['color']}};width:420px;font-weight:bold;"> {{$vector['remark']}} </div>
                  </div>
                  <?php $i = $i % 2 == 0 ? 1 : 0 ?>
                @endforeach
              </div>
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