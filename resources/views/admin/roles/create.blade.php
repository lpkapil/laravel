<?php
use Illuminate\Support\Arr;
?>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2 sidebar-offcanvas" id="sidebar">
            @include('layouts.admin.sidebar', ['active' => "roles"])
        </div>

        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">Create Role </div>
                <div class="panel-body">
                    @include('message.error')
                    {!! Form::open(['route' => ['roles.store']]) !!}
                    @include('admin.roles.form', ['button' => "Save"])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
