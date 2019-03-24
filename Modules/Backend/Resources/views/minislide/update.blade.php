@extends('backend::layouts.main')
@section('page_title')
Sửa: {{ $minislide->name ? $minislide->name : ''}}
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.minislide.index') }}">Danh sách</a></li>
    <li><a href="{{ route('backend.minislide.show', $minislide->id) }}">{{ $minislide->name ? $minislide->name : ''}}</a></li>
    <li class="active">Update</li>
</ul>
@endsection
@section('content')
    {{--<h1>Update minislide: {{ $minislide->name ? $minislide->name : ''}}</h1>--}}
    <div class="sp-push-form">
        <form action="{{ route('backend.minislide.update', $minislide->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
            <input type="hidden" name="_method" value="PUT"/>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['image']) ? 'has-error' : 'has-success'}} @endif">
                <div>
                    <img class="show-images"  class="img-thumbnail" src="{!! $minislide->image ? asset('/').$minislide->image->url : ""!!}" alt="web_image" title="image">
                </div>
                <label class="control-label">Hình ảnh <span class="required">*</span></label>
                <input type="hidden" name="image_old" value="{{ $minislide->image_id  }}">
                <input id="input-b1" name="image" type="file" class="file" accept=".jpg,.gif,.png,.jpeg">
                <div class="help-block">@if($errors->has('image')) {{ $errors->first('image') }} @endif</div>
            </div>

            <div class="form-group  @if (count($errors->all())) {{$errors->has(['title']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label" for="role-name">Tiêu đề</label>
                <input id="role-name" class="form-control{{ $errors->has('title') ? ' has-error' : '' }}" name="title" type="text" value="{{ $minislide->title }}">
                <div class="help-block">@if($errors->has('title')) {{ $errors->first('title') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['link']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label" for="role-link">Link</label>
                <textarea id="role-link" class="form-control{{ $errors->has('link') ? ' has-error' : '' }}" name="link" maxlength="255" rows="3">{{ $minislide->link }}</textarea>
                <div class="help-block">@if($errors->has('link')) {{ $errors->first('link') }} @endif</div>
            </div>

            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>

@endsection

@push('scripts')
    <link rel="stylesheet" href="<?php echo asset('backend/bower_components/bootstrap-fileinput/css/fileinput.css')?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('backend/bower_components/bootstrap-fileinput/css/fileinput-rtl.css')?>" type="text/css">
    <script src="{!! asset('backend/bower_components/bootstrap-fileinput/js/plugins/piexif.js') !!}"></script>
    <script src="{!! asset('backend/bower_components/bootstrap-fileinput/js/fileinput.js') !!}"></script>
@endpush