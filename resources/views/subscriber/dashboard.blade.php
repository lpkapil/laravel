@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2 sidebar-offcanvas" id="sidebar">
            @include('layouts.admin.sidebar', ['active' => "dashboard"])
        </div>
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Subscriber Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection