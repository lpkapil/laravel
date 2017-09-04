@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2 sidebar-offcanvas" id="sidebar">
            @include('layouts.admin.sidebar', ['active' => "media"])
        </div>

        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">Media: {{ $media->name }}</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-5">
                            <img src='{{ $media->url }}' class="previewmedia">
                        </div>
                        <div class="col-md-7">
                            <span>Name:</span> {{ $media->name }}<br><br>
                            <span>Type:</span> {{ $media->type }}<br><br>
                            <span>Size:</span> {{ $media->size }}<br><br>
                            <span>Uploaded By: </span> {{ $media->user->name }}<br><br>
                            <span>Uploaded on:</span> {{ \Carbon\Carbon::parse($media->created_at)->diffForHumans() }}<br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
