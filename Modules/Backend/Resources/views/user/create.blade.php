@extends('backend::layouts.main')
@section('page_title')
Tạo mới admin
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.user.index') }}">Danh sách</a></li>
    <li class="active">Tạo mới admin</li>
</ul>
@endsection
@section('content')
    {{--<h1>Create user</h1>--}}
    <div class="sp-push-form">
        <form action="{{ route('backend.user.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

            <div class="form-group @if (count($errors->all())) {{$errors->has(['username']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Username<span class="required">*</span></label>
                <input type="text" class="form-control{{ $errors->has('username') ? ' has-error' : '' }}" name="username" value="{{ old('username') }}">
                <div class="help-block">@if($errors->has('username')) {{ $errors->first('username') }} @endif</div>
            </div>

            <div class="form-group field-user-password @if (count($errors->all())) {{$errors->has(['password']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label" for="user-password">Password<span class="required">*</span></label>
                <input id="user-password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" type="password" autocomplete="new-password">
                <div class="help-block">@if($errors->has('password')) {{ $errors->first('password') }} @endif</div>
            </div>

            <div class="form-group field-user-email @if (count($errors->all())) {{$errors->has(['email']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label" for="user-email">Email<span class="required">*</span></label>
                <input id="user-email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" type="email" value="{{ old('email') }}">
                <div class="help-block">@if($errors->has('email')) {{ $errors->first('email') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['phone']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Phone number</label>
                <input type="number" class="form-control{{ $errors->has('phone') ? ' has-error' : '' }}" name="phone" value="{{ old('phone') }}">
                <div class="help-block">@if($errors->has('phone')) {{ $errors->first('phone') }} @endif</div>
            </div>

            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Lưu</button>
            </div>

        </form>
    </div>

@endsection

@push('scripts')

@endpush
