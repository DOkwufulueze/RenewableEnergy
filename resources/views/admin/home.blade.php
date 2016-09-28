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
                        <a href="http://localhost:8000/admin/locations">Locations</a> &middot;
                        <a href="http://localhost:8000/admin/distributors">Distributors</a> &middot;
                        <a href="http://localhost:8000/admin/location-distributors">Location Distributors</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
