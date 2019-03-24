@extends('backend::layouts.main')
@section('page_title')
{{ $noithat->title ? $noithat->title : "" }}
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.noithat.index') }}">Danh sách</a></li>
    <li class="active">{{ $noithat->title ? $noithat->title : "" }}</li>
</ul>
@endsection
@section('content')
{{--    <h1>{{ $noithat->title ? $noithat->title : "" }}</h1>--}}
    <p>
        {!! Form::open(['route'=>['backend.noithat.destroy', $noithat->id], 'method'=>'DELETE']) !!}
        <a class="btn btn-success" href="{{ route('backend.noithat.create') }}">Tạo mới</a>
        <a class="btn btn-primary" href="{{ route('backend.noithat.edit', $noithat->id) }}">Sửa</a>
        {!! Form::submit('Xoá',['class'=>'btn btn-danger confirm','onclick'=>'return confirm("Are you sure you want to delete this item?");']) !!}
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
            <tr><th>ID</th><td>{{ $noithat->id }}</td></tr>
            <tr><th>Tiêu đề</th><td>{{ $noithat->title }}</td></tr>
            <tr><th>Slug</th><td>{!! $noithat->slug ? $noithat->slug : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Tóm tắt </th><td>{!! $noithat->tomtat ? $noithat->tomtat : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Nội dung </th><td>{!! $noithat->noidung ? $noithat->noidung : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Ngày tạo</th><td><p class="c_timezone">{{ $noithat->created_at }}</p></td></tr>
            <tr><th>Ngày sửa</th><td><p class="c_timezone">{{ $noithat->updated_at }}</p></td></tr>
            <tr><th>Hình ảnh</th><td>{!! $noithat->image ? "<img  class='show-images' src='".asset('/').$noithat->image->url."' alt=''>" : "<span class='not-set'>(not set)</span>"!!}</td></tr>
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
