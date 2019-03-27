@extends('backend::layouts.main')
@section('page_title')
{{ $tintuc->title ? $tintuc->title : "" }}
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.tintuc.index') }}">Danh sách</a></li>
    <li class="active">{{ $tintuc->title ? $tintuc->title : "" }}</li>
</ul>
@endsection
@section('content')
{{--    <h1>{{ $tintuc->title ? $tintuc->title : "" }}</h1>--}}
    <p>
        {!! Form::open(['route'=>['backend.tintuc.destroy', $tintuc->id], 'method'=>'DELETE']) !!}
        <a class="btn btn-success" href="{{ route('backend.tintuc.create') }}">Tạo mới</a>
        <a class="btn btn-primary" href="{{ route('backend.tintuc.edit', $tintuc->id) }}">Sửa</a>
        {!! Form::submit('Xoá',['class'=>'btn btn-danger confirm','onclick'=>'return confirm("Are you sure you want to delete this item?");']) !!}
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
            <tr><th>ID</th><td>{{ $tintuc->id }}</td></tr>
            <tr><th>Tiêu đề</th><td>{{ $tintuc->title }}</td></tr>
            <tr><th>Slug</th><td>{!! $tintuc->slug ? $tintuc->slug : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Tóm tắt </th><td>{!! $tintuc->tomtat ? $tintuc->tomtat : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Nội dung </th><td>{!! $tintuc->noidung ? $tintuc->noidung : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Ngày tạo</th><td><p class="c_timezone">{{ $tintuc->created_at }}</p></td></tr>
            <tr><th>Ngày sửa</th><td><p class="c_timezone">{{ $tintuc->updated_at }}</p></td></tr>
            <tr><th>Hình ảnh</th><td>{!! $tintuc->image ? "<img  class='show-images' src='".cxl_asset('/').$tintuc->image->url."' alt=''>" : "<span class='not-set'>(not set)</span>"!!}</td></tr>
        </tbody>
    </table>

@endsection

@push('css')
    <style>
        .image-room {
            max-width: 160px;
            margin: 5px;
            display: inline-block;
        }
        .image-room img{
            width: 100%;
        }
    </style>
@endpush

@push('scripts')

@endpush
