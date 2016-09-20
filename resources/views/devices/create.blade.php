@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">New Device</div>
        <div class="panel-body">
          {{Form::model($device, ['route' => ['devices.store', $device->id], 'class' => 'form-horizontal', 'role' => 'form'])}}
            {{ csrf_field() }}
            @include('devices._form')
          {{Form::close()}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
