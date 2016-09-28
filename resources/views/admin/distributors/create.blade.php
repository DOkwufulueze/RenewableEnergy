@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">New Distributor</div>
        <div class="panel-body">
          {{Form::model($distributor, ['route' => ['distributors.store', $distributor->id], 'class' => 'form-horizontal', 'role' => 'form'])}}
            {{ csrf_field() }}
            @include('admin.distributors._form')
          {{Form::close()}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
