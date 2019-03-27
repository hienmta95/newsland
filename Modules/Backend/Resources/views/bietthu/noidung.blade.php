@extends('backend::layouts.main')
@section('page_title')
Tạo mới nội dung
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.bietthu.index') }}">Danh sách</a></li>
    <li class="active">Chọn danh sách nội dung </li>
</ul>
@endsection
@section('content')
    <h1>{{ $bietthu->title }}</h1>
    <div class="sp-push-form">
        <form id="bietthu_create" action="{{ route('backend.bietthu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group @if (count($errors->all())) {{$errors->has(['quan_id']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Chọn quận <span class="required">*</span></label>
                <select class="form-control selectpicker" data-live-search="true" name="quan_id">
                    <option value="">Chọn</option>
                    {{--<option value="{{ $item->id }}" {{ old('quan_id')==$item->id ? "selected" : "" }}>{{ $item->title }}</option>--}}
                </select>
                <div class="help-block">@if($errors->has('quan_id')) {{ $errors->first('quan_id') }} @endif</div>
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
