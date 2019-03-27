@extends('backend::layouts.main')
@section('page_title')
Tạo mới video
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.video.index') }}">Danh sách</a></li>
    <li class="active">Tạo mới video </li>
</ul>
@endsection
@section('content')
    {{--<h1>Create video</h1>--}}
    <div class="sp-push-form">
        <form id="video_create" action="{{ route('backend.video.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group @if (count($errors->all())) {{$errors->has(['title']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Tiêu đề video <span class="required">*</span></label>
                <input type="text" class="form-control{{ $errors->has('title') ? ' has-error' : '' }}" name="title" value="{{ old('title') }}">
                <div class="help-block">@if($errors->has('title')) {{ $errors->first('title') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['video']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Video URL <span class="required">*</span></label>
                <input type="text" class="form-control{{ $errors->has('video') ? ' has-error' : '' }}" name="video" value="{{ old('video') }}" placeholder="video url here">
                <div class="help-block">@if($errors->has('video')) {{ $errors->first('video') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['tomtat']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Tóm tắt<span class="required">*</span></label>
                <textarea id="tomtat" class="form-control{{ $errors->has('tomtat') ? ' has-error' : '' }}" name="tomtat" maxlength="255" rows="3">{{ old('tomtat') }}</textarea>
                <script type="text/javascript">
                    var editor = CKEDITOR.replace('tomtat',{});
                </script>
                <div class="help-block">@if($errors->has('tomtat')) {{ $errors->first('tomtat') }} @endif</div>
            </div>

            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Lưu</button>
            </div>

        </form>
    </div>

@endsection

@push('scripts')

    <link rel="stylesheet" href="<?php echo cxl_asset('backend/bower_components/bootstrap-fileinput/css/fileinput.css')?>" type="text/css">
    <link rel="stylesheet" href="<?php echo cxl_asset('backend/bower_components/bootstrap-fileinput/css/fileinput-rtl.css')?>" type="text/css">
    <script src="{!! cxl_asset('backend/bower_components/bootstrap-fileinput/js/plugins/piexif.js') !!}"></script>
    <script src="{!! cxl_asset('backend/bower_components/bootstrap-fileinput/js/fileinput.js') !!}"></script>

@endpush
