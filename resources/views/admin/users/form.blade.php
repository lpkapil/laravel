{{ csrf_field() }}
<div class="form-group">
    {{ Form::label('name *', null, ['class' => 'control-label']) }}
    {{ Form::text('name', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('email *', null, ['class' => 'control-label']) }}
    {{ Form::email('email', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('password *', null, ['class' => 'control-label']) }}
    {{ Form::password('password', ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('role *', null, ['class' => 'control-label']) }}
    {{ Form::select('role_id', $user->allroles, $role, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('status', null, ['class' => 'control-label']) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    {{ Form::radio('status', 1, true, ['id'=>'status_published']) }}
    {{ Form::label('status_published','Active') }} &nbsp;&nbsp;

    {{ Form::radio('status', 0, false, ['id'=>'status_deleted']) }}
    {{ Form::label('status_deleted', 'Inactive') }}
</div>
<div class="form-group">
    {{ Form::submit($button, ['class' => 'btn btn-primary pull-right']) }}
</div>