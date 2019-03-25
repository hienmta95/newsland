@extends('backend::layouts.main')
@section('page_title')
Tạo mới tỉnh / thành phố
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.thanhpho.index') }}">Danh sách</a></li>
    <li class="active">Tạo mới tỉnh / thành phố</li>
</ul>
@endsection
@section('content')
    {{--<h1>Create thanhpho</h1>--}}
    <div class="sp-push-form">
        <form action="{{ route('backend.thanhpho.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

            <div class="form-group  @if (count($errors->all())) {{$errors->has(['title']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label" for="role-name">Tên <span class="required">*</span></label>
                <input id="role-name" class="form-control{{ $errors->has('title') ? ' has-error' : '' }}" name="title" type="text" value="{{ old('title') }}">
                <div class="help-block">@if($errors->has('title')) {{ $errors->first('title') }} @endif</div>
            </div>

            <div class="form-group  @if (count($errors->all())) {{$errors->has(['slug']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label" for="role-name">Tên trên URL </label>
                <input id="role-name" class="form-control{{ $errors->has('slug') ? ' has-error' : '' }}" name="slug" type="text" value="{{ old('slug') }}">
                <div class="help-block">@if($errors->has('slug')) {{ $errors->first('slug') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['tenmien']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Thuộc miền <span class="required">*</span></label>
                <select class="form-control selectpicker" data-live-search="true" name="tenmien" required>
                    <option value="">Chọn</option>
                    <option value="mienbac" {{ old('tenmien') == "mienbac" ? "selected" : "" }}>Miền Bắc</option>
                    <option value="mientrung" {{ old('tenmien') == "mientrung" ? "selected" : "" }}>Miền Trung</option>
                    <option value="miennam" {{ old('tenmien') == "miennam" ? "selected" : "" }}>Miền Nam</option>
                </select>
                <div class="help-block">@if($errors->has('tenmien')) {{ $errors->first('tenmien') }} @endif</div>
            </div>

            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Create</button>
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
