@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">New Location</div>
        <div class="panel-body">
          {{Form::model($location, ['route' => ['locations.store', $location->id], 'class' => 'form-horizontal', 'role' => 'form'])}}
            {{ csrf_field() }}
            @include('admin.locations._form')
          {{Form::close()}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
