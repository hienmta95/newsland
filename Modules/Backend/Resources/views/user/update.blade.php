@extends('backend::layouts.main')
@section('page_title')
Sửa: {{ $user->username ? $user->username : ''}}
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.user.index') }}">Danh sách</a></li>
    <li><a href="{{ route('backend.user.show', $user->id) }}">{{ $user->username ? $user->username : ''}}</a></li>
    <li class="active">Update</li>
</ul>
@endsection
@section('content')
    {{--<h1>Sửa thông tin admin: {{ $user->username ? $user->username : ''}}</h1>--}}
    <div class="sp-push-form">
        <form action="{{ route('backend.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
            <input type="hidden" name="_method" value="PUT"/>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['username']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Username<span class="required">*</span></label>
                <input type="text" class="form-control{{ $errors->has('username') ? ' has-error' : '' }}" name="username" value="{{ $user->username }}">
                <div class="help-block">@if($errors->has('username')) {{ $errors->first('username') }} @endif</div>
            </div>

            <div class="form-group field-user-email @if (count($errors->all())) {{$errors->has(['email']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label" for="user-email">Email<span class="required">*</span></label>
                <input id="user-email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" type="email" value="{{ $user->email }}">
                <div class="help-block">@if($errors->has('email')) {{ $errors->first('email') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['phone']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Phone number</label>
                <input type="number" class="form-control{{ $errors->has('phone') ? ' has-error' : '' }}" name="phone" value="{{ $user->phone }}">
                <div class="help-block">@if($errors->has('phone')) {{ $errors->first('phone') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['password_repeat']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Password mới<span class="required">*</span></label>
                <input id="show-password-new" type="checkbox" class="marg-right"><label for="show-password-new"> Show</label>
                <input id="new-password" class="form-control{{ $errors->has('password_new') ? ' is-invalid' : '' }}" name="password_new" type="password" value="{{ old('password_new') }}" placeholder="******">
                <div class="help-block">@if($errors->has('password_new')) {{ $errors->first('password_new') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['password_repeat']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Password mới (xác nhận lại)<span class="required">*</span></label>
                <input id="show-password-repeat" type="checkbox" class="marg-right"><label for="show-password-repeat"> Show</label>
                <input id="repeat-password" class="form-control{{ $errors->has('password_repeat') ? ' is-invalid' : '' }}" name="password_repeat" type="password" value="{{ old('password_repeat') }}" placeholder="******">
                <div class="help-block">@if($errors->has('password_repeat')) {{ $errors->first('password_repeat') }} @endif</div>
            </div>

            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>

@endsection

@push('scripts')
    <link rel="stylesheet" href="<?php echo cxl_asset('admin/bower_components/bootstrap-fileinput/css/fileinput.css')?>" type="text/css">
    <link rel="stylesheet" href="<?php echo cxl_asset('admin/bower_components/bootstrap-fileinput/css/fileinput-rtl.css')?>" type="text/css">

    <script src="{!! cxl_asset('admin/bower_components/bootstrap-fileinput/js/plugins/piexif.js') !!}"></script>
    <script src="{!! cxl_asset('admin/bower_components/bootstrap-fileinput/js/fileinput.js') !!}"></script>

    <script>
        $(document).ready(function () {
            $("#show-password-new").change(function () {
                if ($(this).is(':checked')){
                    $("#new-password").attr("type", "text");
                } else {
                    $("#new-password").attr("type", "password");
                }
            });
            $("#show-password-repeat").change(function () {
                if ($(this).is(':checked')){
                    $("#repeat-password").attr("type", "text");
                } else {
                    $("#repeat-password").attr("type", "password");
                }
            });

        });
    </script>
@endpush

@push('css')
    <style>
        .marg-right {
            margin: 0 5px 0 50px !important;
        }
    </style>
@endpush

