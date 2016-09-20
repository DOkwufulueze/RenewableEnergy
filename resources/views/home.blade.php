@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="links">
                        <a href="http://localhost:8000/users">Users</a> &middot;
                        <a href="http://localhost:8000/vectors">Vectors</a> &middot;
                        <a href="http://localhost:8000/devices/create">Create New Device</a> &middot;
                        <a href="http://localhost:8000/devices">Devices</a> &middot;
                        <a href="http://localhost:8000/usages">Device Usage</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
