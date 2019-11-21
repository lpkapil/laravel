<?php
use Illuminate\Support\Arr;
?>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2 sidebar-offcanvas" id="sidebar">
            @include('layouts.admin.sidebar', ['active' => "users"])
        </div>

        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">Create User </div>
                <div class="panel-body">
                    @include('message.error')
                    {!! Form::open(['route' => ['users.store']]) !!}
                    @include('admin.users.form', ['button' => "Save", 'role' => null])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
