@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2 sidebar-offcanvas" id="sidebar">
            @include('layouts.admin.sidebar', ['active' => "roles"])
        </div>

        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">Roles <a href="{{ url('/dashboard/roles/create') }}" class="btn btn-sm btn-default pull-right" role="button"><span class="glyphicon glyphicon-pencil"></span> Add Role</a></div>
                <div class="panel-body">
                    <table id="adminpages" class="adminrolelisting table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Last Updated</th>
                                <th class="no-sort">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($roles))
                            @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>{{ ($role->status == 1) ? 'Active' : 'Inactive' }}</td>
                                <td>{{ \Carbon\Carbon::parse($role->updated_at)->format('j M Y, h:i:s A') }}</td>
                                <td>
                                    @if($role->name != 'admin')
                                    <a href="{{ url('/dashboard/roles/'.$role->id.'/edit') }}" data-toggle="tooltip" title="Edit Role">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    <a href="#" class="delete_role" data-id="{{ $role->id }}" data-toggle="tooltip" title="Delete Role">
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
