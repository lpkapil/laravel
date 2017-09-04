@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="content">
                <div class="m-b-md">
                    @if(!empty($post))
                    <div class="well">
                        <div class="row">
                            <div class="col-md-12 text-left">
                                <strong>{{ $post->title }}</strong>
                                <div class="padding10">
                                    {!! $post->content !!}
                                </div>
                                <div class="padding10">
                                    @if(Auth::user() && ((Auth::user()->id == $post->user_id) || (Auth::user()->roles->first()->name == 'admin')))
                                    <a href="{{ url('dashboard/posts/'.$post->id.'/edit')}}" class="editlink" data-toggle="tooltip" title="Edit Post"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                    @endif
                                    &nbsp;<span class="glyphicon glyphicon-user" data-toggle="tooltip" title="Post Author"></span> {{ $post->user->name }}
                                    &nbsp;<span class="glyphicon glyphicon-calendar" data-toggle="tooltip" title="Post Created"></span> {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection