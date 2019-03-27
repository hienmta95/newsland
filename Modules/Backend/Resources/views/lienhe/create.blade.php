@extends('backend::layouts.main')
@section('page_title')
Tạo mới page
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.page.index') }}">Danh sách</a></li>
    <li class="active">Tạo mới page</li>
</ul>
@endsection
@section('content')
    {{--<h1>Create page</h1>--}}
    <div class="sp-push-form">
        <form action="{{ route('backend.page.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

            <div class="form-group @if (count($errors->all())) {{$errors->has(['title']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Tên page</label>
                <input type="text" class="form-control{{ $errors->has('title') ? ' has-error' : '' }}" name="title" value="{{ old('title') }}">
                <div class="help-block">@if($errors->has('title')) {{ $errors->first('title') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['slug']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Tên hiển thị trên link </label>
                <input type="text" class="form-control{{ $errors->has('slug') ? ' has-error' : '' }}" name="slug" value="{{ old('slug') }}" placeholder="news-land-slug">
                <div class="help-block">@if($errors->has('slug')) {{ $errors->first('slug') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['content']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Nội dung </label>
                <textarea id="content_page" class="form-control{{ $errors->has('content') ? ' has-error' : '' }}" name="content" maxlength="255" rows="3">{{ old('content') }}</textarea>
                <div class="help-block">@if($errors->has('content')) {{ $errors->first('content') }} @endif</div>
            </div>

            <div class="form-group">
                <label class="control-label">Kích hoạt</label>
                <div>
                    <label class="radio-inline"><input type="radio" name="kichhoat" value="1" {{ old('kichhoat') == 1 ? "checked" : "" }}>Yes</label>
                    <label class="radio-inline"><input type="radio" name="kichhoat" value="0" {{ old('kichhoat') == 0 ? "checked" : "" }}>No</label>
                </div>
            </div>

            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Lưu</button>
            </div>

        </form>
    </div>

@endsection

@push('scripts')

    <script src="{!! cxl_asset('/backend/bower_components/ckeditor/ckeditor.js') !!}"></script>
    <script> CKEDITOR.replace('content_page'); </script>

@endpush
