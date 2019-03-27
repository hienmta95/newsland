@extends('backend::layouts.main')
@section('page_title')
    Sửa thông tin: {{ $lienhe->hoten ? $lienhe->hoten : ''}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
        <li><a href="{{ route('backend.lienhe.index') }}">Danh sách</a></li>
        <li><a href="{{ route('backend.lienhe.show', $lienhe->id) }}">{{ $lienhe->hoten ? $lienhe->hoten : ''}}</a></li>
        <li class="active">Update</li>
    </ul>
@endsection
@section('content')
    {{--    <h1>Sửa thông tin lĩnh vực: {{ $lienhe->title ? $lienhe->title : ''}}</h1>--}}
    <div class="sp-push-form">
        <form action="{{ route('backend.lienhe.update', $lienhe->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PUT"/>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['title']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Họ tên</label>
                <input type="text" class="form-control{{ $errors->has('title') ? ' has-error' : '' }}" name="title" value="{{ $lienhe->hoten }}" readonly="readonly">
                <div class="help-block">@if($errors->has('title')) {{ $errors->first('title') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['sdt']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">SĐT</label>
                <input type="text" class="form-control{{ $errors->has('title') ? ' has-error' : '' }}" name="sdt" value="{{ $lienhe->sdt }}" readonly="readonly">
                <div class="help-block">@if($errors->has('sdt')) {{ $errors->first('sdt') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['title']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Email</label>
                <input type="text" class="form-control{{ $errors->has('title') ? ' has-error' : '' }}" name="title" value="{{ $lienhe->email }}" readonly="readonly">
                <div class="help-block">@if($errors->has('title')) {{ $errors->first('title') }} @endif</div>
            </div>

            <div class="form-group">
                <label class="control-label">Trạng thái</label>
                <div>
                    <label class="radio-inline"><input type="radio" name="trangthai" value="1" {{ $lienhe->trangthai == 1 ? "checked" : "" }}>Đã xử lý </label>
                    <label class="radio-inline"><input type="radio" name="trangthai" value="0" {{ $lienhe->trangthai == 0 ? "checked" : "" }}>Chưa xử lý </label>
                </div>
            </div>

            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>

@endsection

@push('scripts')

    <script src="{!! asset('/backend/bower_components/ckeditor/ckeditor.js') !!}"></script>
    <script> CKEDITOR.replace('content_lienhe'); </script>

@endpush
