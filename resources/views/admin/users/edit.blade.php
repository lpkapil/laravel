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
                <div class="panel-heading clearfix">Edit User: {{ $user->name }} </div>
                <div class="panel-body">
                    @include('message.error')
                    {!! Form::model($user, ['method' => 'PUT', 'route' => ['users.update', $user->id]]) !!}
                    @include('admin.users.form', ['button' => "Update", 'role' => $user->roles->first()->id])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
