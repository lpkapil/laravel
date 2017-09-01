@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2 sidebar-offcanvas" id="sidebar">
            @include('layouts.admin.sidebar', ['active' => "media"])
        </div>

        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">Add Media </div>
                <div class="panel-body">
                    @include('message.error')
                    {!! Form::open(['route' => 'media.store', 'files' => true, 'class' => 'dropzone', 'id' => 'mediaitem']) !!}
                    @include('admin.media.form', ['button' => "Upload"])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">
<script src="{{ asset('js/dropzone.js') }}"></script>
<script type="text/javascript">
Dropzone.options.mediaitem = {
    maxFilesize: 5,
    acceptedFiles: ".jpeg,.jpg,.png,.gif",
};

Dropzone.options.mediaitem = {
    init: function () {
        this.on("complete", function (file) {
            if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                toastr.info('Files Uploaded Successfully');
                setTimeout(function () {
                    window.location.href = '/dashboard/media';
                }, 500);
            }
        });
    }
};
</script>

@endsection
