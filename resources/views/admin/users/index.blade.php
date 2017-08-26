@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2 sidebar-offcanvas" id="sidebar">
            @include('layouts.admin.sidebar', ['active' => "users"])
        </div>

        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">Users <a href="{{ url('/dashboard/users/create') }}" class="btn btn-sm btn-default pull-right" role="button"><span class="glyphicon glyphicon-pencil"></span> Add User</a></div>
                <div class="panel-body">
                    <table id="adminpages" class="adminlisting table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Last Updated</th>
                                <th class="no-sort">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($users))
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->roles->first()->name }}</td>
                                <td>{{ ($user->status == 1) ? 'Active' : 'Inactive' }}</td>
                                <td>{{ \Carbon\Carbon::parse($user->updated_at)->format('j M Y, h:i:s A') }}</td>
                                <td>
                                    <a href="{{ url('/dashboard/users/'.$user->id.'/edit') }}" data-toggle="tooltip" title="Edit User">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    @if($user->roles->first()->name == 'admin')
                                    <a href="#" class="disabled" data-id="{{ $user->id }}" data-toggle="tooltip" title="Disabled">
                                        <span class="glyphicon glyphicon-trash btn-default" role="button"></span>
                                    </a>
                                    @else
                                    <a href="#" class="delete_user" data-id="{{ $user->id }}" data-toggle="tooltip" title="Delete User">
                                        <span class="glyphicon glyphicon-trash" role="button"></span>
                                    </a>
                                    @endif
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
