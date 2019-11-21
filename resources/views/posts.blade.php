<?php
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
?>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="content">
                <div class="m-b-md">
                    @if(!empty($posts))
                    @foreach($posts as $post)
                    <div class="well">
                        <div class="row">
                            <div class="col-md-12 text-left">
                                <strong>{{ $post->title }}</strong>
                                <div class="padding10">
                                    {!! Str::limit($post->content, $limit = 500, $end = '...') !!}
                                </div>
                            </div>
                        </div>
                        <div class="row padding10">
                            <div class="col-md-10 text-left">
                                @if(Auth::user() && ((Auth::user()->id == $post->user_id) || (Auth::user()->roles->first()->name == 'admin')))
                                <a href="{{ url('dashboard/posts/'.$post->id.'/edit')}}" class="editlink" data-toggle="tooltip" title="Edit Post"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                @endif
                                &nbsp;<span class="glyphicon glyphicon-user" data-toggle="tooltip" title="Post Author"></span> {{ $post->user->name }}
                                &nbsp;<span class="glyphicon glyphicon-calendar" data-toggle="tooltip" title="Post Created"></span> {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
                            </div>
                            <div class="col-md-2 text-right">
                                <a href="{{ url('posts/'.$post->id)}}"><button type="button" class="btn btn-default btn-sm">Read More</button></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="pull-right">
                        {{ $posts->links() }}
                    </div>
                    @else
                    <p> No Posts Found. </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection