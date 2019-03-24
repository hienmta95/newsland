@extends('backend::layouts.main')
@section('page_title')
{{ $video->title ? $video->title : "" }}
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.video.index') }}">Danh sách</a></li>
    <li class="active">{{ $video->title ? $video->title : "" }}</li>
</ul>
@endsection
@section('content')
    <p>
        {!! Form::open(['route'=>['backend.video.destroy', $video->id], 'method'=>'DELETE']) !!}
        <a class="btn btn-success" href="{{ route('backend.video.create') }}">Tạo mới</a>
        <a class="btn btn-primary" href="{{ route('backend.video.edit', $video->id) }}">Sửa</a>
        {!! Form::submit('Xoá',['class'=>'btn btn-danger confirm','onclick'=>'return confirm("Are you sure you want to delete this item?");']) !!}
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
            <tr><th>ID</th><td>{{ $video->id }}</td></tr>
            <tr><th>Tiêu đề</th><td>{{ $video->title }}</td></tr>
            <tr><th>Slug</th><td>{!! $video->slug ? $video->slug : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Tóm tắt </th><td>{!! $video->tomtat ? $video->tomtat : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Nội dung </th><td>{!! $video->noidung ? $video->noidung : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Video URL </th><td>{!! $video->video ? $video->video : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Ngày tạo</th><td><p class="c_timezone">{{ $video->created_at }}</p></td></tr>
            <tr><th>Ngày sửa</th><td><p class="c_timezone">{{ $video->updated_at }}</p></td></tr>
            <tr><th>Hình ảnh</th><td>{!! $video->image ? "<img  class='show-images' src='".asset('/'). $video->image->url ."' alt=''>" : "<span class='not-set'>(not set)</span>"!!}</td></tr>
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
