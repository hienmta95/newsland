@extends('backend::layouts.main')
@section('page_title')
Tạo mới loại chung cư
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.theloai.index') }}">Danh sách</a></li>
    <li class="active">Tạo mới thể loại </li>
</ul>
@endsection
@section('content')
    <div class="sp-push-form">
        <form action="{{ route('backend.theloai.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

            <div class="form-group  @if (count($errors->all())) {{$errors->has(['title']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label" for="role-name">Tiêu đề <span class="required">*</span></label>
                <input id="role-name" class="form-control{{ $errors->has('title') ? ' has-error' : '' }}" name="title" type="text" value="{{ old('title') }}">
                <div class="help-block">@if($errors->has('title')) {{ $errors->first('title') }} @endif</div>
            </div>

            <div class="form-group  @if (count($errors->all())) {{$errors->has(['slug']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label" for="role-name">Tên trên URL </label>
                <input id="role-name" class="form-control{{ $errors->has('slug') ? ' has-error' : '' }}" name="slug" type="text" value="{{ old('slug') }}">
                <div class="help-block">@if($errors->has('slug')) {{ $errors->first('slug') }} @endif</div>
            </div>

            <div class="form-group  @if (count($errors->all())) {{$errors->has(['order']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label" for="role-name">Số thứ tự hiển thị <span class="required">*</span></label>
                <input id="role-name" class="form-control{{ $errors->has('order') ? ' has-error' : '' }}" name="order" type="number" value="{{ old('oder') }}">
                <div class="help-block">@if($errors->has('order')) {{ $errors->first('order') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['active']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Hiển thị hay không <span class="required">*</span></label>
                <div>
                    <label class="radio-inline"><input type="radio" name="active" value="1" @if(old('active') == 1) {!! 'checked'!!} @endif ><strong>Có</strong></label>
                    <label class="radio-inline"><input type="radio" name="active" value="0" @if(old('active') == 0) {!! 'checked'!!} @endif ><strong>Không</strong></label>
                </div>
                <div class="help-block">@if($errors->has('active')) {{ $errors->first('active') }} @endif</div>
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
