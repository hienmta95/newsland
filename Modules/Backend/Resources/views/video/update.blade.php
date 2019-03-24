@extends('backend::layouts.main')
@section('page_title')
    Sửa thông tin: {{ $video->title ? $video->title : ''}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
        <li><a href="{{ route('backend.video.index') }}">Danh sách</a></li>
        <li><a href="{{ route('backend.video.show', $video->id) }}">{{ $video->title ? $video->title : ''}}</a></li>
        <li class="active">Update</li>
    </ul>
@endsection
@section('content')
    {{--    <h1>Sửa thông tin phòng: {{ $video->title ? $video->title : ''}}</h1>--}}
    <div class="sp-push-form">
        <form action="{{ route('backend.video.update', $video->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PUT"/>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['title']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Tiêu đề video <span class="required">*</span></label>
                <input type="text" class="form-control{{ $errors->has('title') ? ' has-error' : '' }}" name="title" value="{{ $video->title }}">
                <div class="help-block">@if($errors->has('title')) {{ $errors->first('title') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['slug']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Tên hiển thị trên link<span class="required">*</span></label>
                <input type="text" class="form-control{{ $errors->has('slug') ? ' has-error' : '' }}" name="slug" value="{{ $video->slug }}">
                <div class="help-block">@if($errors->has('slug')) {{ $errors->first('slug') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['video']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Video URL <span class="required">*</span></label>
                <input type="text" class="form-control{{ $errors->has('video') ? ' has-error' : '' }}" name="video" value="{{ $video->video }}">
                <div class="help-block">@if($errors->has('video')) {{ $errors->first('video') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['image']) ? 'has-error' : 'has-success'}} @endif">
                <div>
                    <img class="show-images"  class="img-thumbnail" src="{!! $video->image ? asset('/').$video->image->url : ""!!}" alt="web_image" title="image">
                </div>
                <label class="control-label">Hình ảnh </label>
                <input type="hidden" name="image_old" value="{{ $video->image_id  }}">
                <input id="input-b1" name="image" type="file" class="file" accept=".jpg,.gif,.png,.jpeg">
                <div class="help-block">@if($errors->has('image')) {{ $errors->first('image') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['noidung']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Nội dung<span class="required">*</span></label>
                <textarea id="noidung_video" class="form-control{{ $errors->has('noidung') ? ' has-error' : '' }}" name="noidung" maxlength="255" rows="3">{{ $video->noidung }}</textarea>
                <script type="text/javascript">
                    var editor = CKEDITOR.replace('noidung_video',{
                        language:'vi',
                        filebrowserBrowseUrl :'/js/ckfinder/ckfinder.html',
                        filebrowserImageBrowseUrl : '/js/ckfinder/ckfinder.html?type=Images',
                        filebrowserFlashBrowseUrl : '/js/ckfinder/ckfinder.html?type=Flash',
                        filebrowserUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                        filebrowserImageUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                        filebrowserFlashUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                    });
                </script>
                <div class="help-block">@if($errors->has('noidung')) {{ $errors->first('noidung') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['tomtat']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Tóm tắt<span class="required">*</span></label>
                <textarea id="tomtat" class="form-control{{ $errors->has('tomtat') ? ' has-error' : '' }}" name="tomtat" maxlength="255" rows="3">{{ $video->tomtat }}</textarea>
                <script type="text/javascript">
                    var editor = CKEDITOR.replace('tomtat',{});
                </script>
                <div class="help-block">@if($errors->has('tomtat')) {{ $errors->first('tomtat') }} @endif</div>
            </div>

            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>

@endsection

@push('scripts')

    <link rel="stylesheet" href="<?php echo asset('backend/bower_components/bootstrap-fileinput/css/fileinput.css')?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('backend/bower_components/bootstrap-fileinput/css/fileinput-rtl.css')?>" type="text/css">

    <script src="{!! asset('backend/bower_components/bootstrap-fileinput/js/plugins/piexif.js') !!}"></script>
    <script src="{!! asset('backend/bower_components/bootstrap-fileinput/js/plugins/sortable.js') !!}"></script>
    <script src="{!! asset('backend/bower_components/bootstrap-fileinput/js/plugins/purify.js') !!}"></script>
    <script src="{!! asset('backend/bower_components/bootstrap-fileinput/js/fileinput.js') !!}"></script>

@endpush