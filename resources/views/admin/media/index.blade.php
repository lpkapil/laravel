@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2 sidebar-offcanvas" id="sidebar">
            @include('layouts.admin.sidebar', ['active' => "media"])
        </div>

        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">Media <a href="{{ url('/dashboard/media/create') }}" class="btn btn-sm btn-default pull-right" role="button"><span class="glyphicon glyphicon-pencil"></span> Add Media</a></div>
                <div class="panel-body">
                    <table id="adminpages" class="adminlisting table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Size</th>
                                <th>Uploaded By</th>
                                <th>Last Updated</th>
                                <th class="no-sort">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($mediaitems))
                            @foreach($mediaitems as $medium)
                            <tr>
                                <td>{{ $medium->name}}</td>
                                <td>{{ $medium->size}}</td>
                                <td>{{ $medium->type}}</td>
                                <td>{{ $medium->user->name}}</td>
                                <td>{{ \Carbon\Carbon::parse($medium->updated_at)->format('j M Y, h:i:s A') }}</td>
                                <td>
                                    <a href="#" class="delete_media" data-id="{{ $medium->id }}" data-toggle="tooltip" title="Delete Media">
                                        <span class="glyphicon glyphicon-trash" role="button"></span>
                                    </a>
                                    &nbsp;<a href="{{ url('/dashboard/media/'.$medium->id) }}" data-toggle="tooltip" title="View Media">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5">No records found.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
