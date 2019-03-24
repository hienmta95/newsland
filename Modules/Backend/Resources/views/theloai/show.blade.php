@extends('backend::layouts.main')
@section('page_title')
Chi tiết: {{ $theloai->title ? $theloai->title : "" }}
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.theloai.index') }}">Danh sách </a></li>
    <li class="active">{{ $theloai->title ? $theloai->title : "" }}</li>
</ul>
@endsection
@section('content')
    <p>
        {!! Form::open(['route'=>['backend.theloai.destroy', $theloai->id], 'method'=>'DELETE']) !!}
        <a class="btn btn-success" href="{{ route('backend.theloai.create') }}">Create thể loại </a>
        <a class="btn btn-primary" href="{{ route('backend.theloai.edit', $theloai->id) }}">Update</a>
        {!! Form::submit('Delete',['class'=>'btn btn-danger confirm','onclick'=>'return confirm("Are you sure you want to delete this item?");']) !!}
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
            <tr><th>ID</th><td>{{ $theloai->id }}</td></tr>
            <tr><th>Tiêu đề</th><td>{!! $theloai->title ? $theloai->title : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Tên trên url</th><td>{!! $theloai->slug ? $theloai->slug : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Số thứ tự hiển thị </th><td>{!! $theloai->order !!}</td></tr>
            <tr><th>Created At</th><td><p class="c_timezone">{{ $theloai->created_at }}</p></td></tr>
            <tr><th>Updated At</th><td><p class="c_timezone">{{ $theloai->updated_at }}</p></td></tr>
        </tbody>
    </table>

@endsection

@push('scripts')

@endpush
