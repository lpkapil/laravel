@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2 sidebar-offcanvas" id="sidebar">
            @include('layouts.admin.sidebar', ['active' => "posts"])
        </div>

        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">Edit Post: {{ $post->id }} </div>
                <div class="panel-body">
                    @include('message.error')
                    {!! Form::model($post, ['method' => 'PUT', 'route' => ['posts.update', $post->id]]) !!}
                    @include('admin.posts.form', ['button' => "Update"])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
