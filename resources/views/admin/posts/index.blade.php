@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2 sidebar-offcanvas" id="sidebar">
            @include('layouts.admin.sidebar', ['active' => "posts"])
        </div>

        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">Posts <a href="{{ url('/dashboard/posts/create') }}" class="btn btn-sm btn-default pull-right" role="button"><span class="glyphicon glyphicon-pencil"></span> Add Post</a></div>
                <div class="panel-body">
                    <table id="adminpages" class="adminlisting table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Author</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th class="no-sort">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($posts))
                            @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>{{ ($post->status == '1') ? 'Published' : 'Deleted' }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($post->created_at)->format('j M Y, h:i:s A') }}</td>
                                <td>{{ \Carbon\Carbon::parse($post->updated_at)->format('j M Y, h:i:s A') }}</td>
                                <td>
                                    <a href="{{ url('/dashboard/posts/'.$post->id.'/edit') }}">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    <a href="#" class="delete_post" data-id="{{ $post->id }}">
                                        <span class="glyphicon glyphicon-trash" role="button"></span>
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
