@if(Auth::user()->roles->first()->name == 'admin')
<div class="list-group">
    <a href="{{ url('/dashboard') }}" class="list-group-item {{ $active == 'dashboard'  ? 'active': '' }}"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp; Home</a>
    <a href="{{ url('/dashboard/posts') }}" class="list-group-item {{ $active == 'posts'  ? 'active': '' }}"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp; Posts</a>
    <a href="{{ url('/dashboard/media') }}" class="list-group-item {{ $active == 'media'  ? 'active': '' }}"><span class="glyphicon glyphicon-picture"></span>&nbsp;&nbsp; Media</a>
    <a href="{{ url('/dashboard/users') }}" class="list-group-item {{ $active == 'users'  ? 'active': '' }}"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; Users</a>
    <a href="{{ url('/dashboard/roles') }}" class="list-group-item {{ $active == 'roles'  ? 'active': '' }}"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp; Roles</a>
    <!--<a href="{{ url('/dashboard/settings') }}" class="list-group-item {{ $active == 'settings'  ? 'active': '' }}"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp; Settings</a>-->
    <!--<a href="{{ url('/dashboard/tools') }}" class="list-group-item {{ $active == 'tools'  ? 'active': '' }}"><span class="glyphicon glyphicon-wrench"></span>&nbsp;&nbsp; Tools</a>-->
</div>
@else
<div class="list-group">
    <a href="{{ url('/dashboard') }}" class="list-group-item {{ $active == 'dashboard'  ? 'active': '' }}"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp; Home</a>
    <a href="{{ url('/dashboard/posts') }}" class="list-group-item {{ $active == 'posts'  ? 'active': '' }}"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp; Posts</a>
    <a href="{{ url('/dashboard/media') }}" class="list-group-item {{ $active == 'media'  ? 'active': '' }}"><span class="glyphicon glyphicon-picture"></span>&nbsp;&nbsp; Media</a>
    <!--<a href="{{ url('/dashboard/tools') }}" class="list-group-item {{ $active == 'tools'  ? 'active': '' }}"><span class="glyphicon glyphicon-wrench"></span>&nbsp;&nbsp; Tools</a>-->
</div>
@endif