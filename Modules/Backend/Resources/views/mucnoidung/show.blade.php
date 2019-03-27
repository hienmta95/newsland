@extends('backend::layouts.main')
@section('page_title')
Chi tiết: {{ $mucnoidung->title ? $mucnoidung->title : "" }}
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.mucnoidung.index') }}">Danh sách </a></li>
    <li class="active">{{ $mucnoidung->title ? $mucnoidung->title : "" }}</li>
</ul>
@endsection
@section('content')
    <p>
        {!! Form::open(['route'=>['backend.mucnoidung.destroy', $mucnoidung->id], 'method'=>'DELETE']) !!}
        <a class="btn btn-success" href="{{ route('backend.mucnoidung.create') }}">Create mục nội dung </a>
        <a class="btn btn-primary" href="{{ route('backend.mucnoidung.edit', $mucnoidung->id) }}">Update</a>
        {!! Form::submit('Delete',['class'=>'btn btn-danger confirm','onclick'=>'return confirm("Are you sure you want to delete this item?");']) !!}
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
            <tr><th>ID</th><td>{{ $mucnoidung->id }}</td></tr>
            <tr><th>Tiêu đề</th><td>{!! $mucnoidung->title ? $mucnoidung->title : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Tên ngắn</th><td>{!! $mucnoidung->slug ? $mucnoidung->slug : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Created At</th><td><p class="c_timezone">{{ $mucnoidung->created_at }}</p></td></tr>
            <tr><th>Updated At</th><td><p class="c_timezone">{{ $mucnoidung->updated_at }}</p></td></tr>
        </tbody>
    </table>

@endsection

@push('scripts')

@endpush
