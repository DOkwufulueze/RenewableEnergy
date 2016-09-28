@extends('layouts.app')
<link href="{{URL::asset('css/shared.css')}}" rel="stylesheet" type="text/css">
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Distributors</div>
        <div class="panel-body">
          @if (count($distributors) > 0)
            <?php
              $i = 0;
              $colorCodes = ['#dedede', '#efefef'];
            ?>
            <div class="wrapper">
              <div class="data-row">
                <div class="data-column" style="background: {{$colorCodes[1]}}; width: 300px;">NAME</div>
                <div class="data-column" style="background: #ffffff; width: 50px;height:20px;"> </div>
                <div class="data-column" style="background: #ffffff; width: 50px;height:20px;"> </div>
              </div>
              @foreach ($distributors as $distributor)
                <div class="data-row">
                  <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 300px;">{{ $distributor['name'] }}</div>
                  <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 50px;"><a href="/admin/distributors/{{$distributor['id']}}/edit">Edit</a></div>
                  <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 50px;">
                    {{Form::open(['method' => 'DELETE', 'route' => ['distributors.destroy', $distributor['id']]])}}
                      {{Form::submit('Delete', ['class' => 'delete-button', 'style' => 'height:20px;font-size:11px;', 'onmousedown' => 'confirmDelete(this)'])}}
                    {{Form::close()}}
                  </div>
                </div>
                <?php $i = $i % 2 == 0 ? 1 : 0 ?>
              @endforeach
            </div>
          @else
            <div class="wrapper">
              <strong>No Distributor Registered yet</strong>.
            </div>
          @endif
          <div class="line-break"></div>
          <div class="line-break"></div>
          <div class="line-break"></div>
          <div class="links">
            <a href="http://localhost:8000/users">Users</a> &middot;
            <a href="http://localhost:8000/vectors">Vectors</a> &middot;
            <a href="http://localhost:8000/admin/locations">Locations</a> &middot;
            <a href="http://localhost:8000/admin/distributors/create">New Distributors</a> &middot;
            <a href="http://localhost:8000/admin/location-distributors">Location Distributors</a> &middot;
            <a href="http://localhost:8000/admin/user-location-distributors">User Location Distributors</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="{{URL::asset('js/distributors.js')}}"></script>
@endsection
