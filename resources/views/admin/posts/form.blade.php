{{ csrf_field() }}
<div class="form-group">
    {{ Form::label('title *', null, ['class' => 'control-label']) }}
    {{ Form::text('title', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('content *', null, ['class' => 'control-label']) }}
    {{ Form::textarea('content', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('status', null, ['class' => 'control-label']) }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    {{ Form::radio('status', 1, true, ['id'=>'status_published']) }}
    {{ Form::label('status_published','Published') }} &nbsp;&nbsp;

    {{ Form::radio('status', 0, false, ['id'=>'status_deleted']) }}
    {{ Form::label('status_deleted', 'Deleted') }}
</div>
<div class="form-group">
    {{ Form::submit($button, ['class' => 'btn btn-primary pull-right']) }}
</div>