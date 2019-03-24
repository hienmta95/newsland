@extends('backend::layouts.main')
@section('page_title')
Chi tiết: {{ $quan->title ? $quan->title : "" }}
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.quan.index') }}">Danh sách </a></li>
    <li class="active">{{ $quan->title ? $quan->title : "" }}</li>
</ul>
@endsection
@section('content')
    <p>
        {!! Form::open(['route'=>['backend.quan.destroy', $quan->id], 'method'=>'DELETE']) !!}
        <a class="btn btn-success" href="{{ route('backend.quan.create') }}">Create quận / huyện </a>
        <a class="btn btn-primary" href="{{ route('backend.quan.edit', $quan->id) }}">Update</a>
        {!! Form::submit('Delete',['class'=>'btn btn-danger confirm','onclick'=>'return confirm("Are you sure you want to delete this item?");']) !!}
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
            <tr><th>ID</th><td>{{ $quan->id }}</td></tr>
            <tr><th>Tên</th><td>{!! $quan->title ? $quan->title : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Tên trên url</th><td>{!! $quan->slug ? $quan->slug : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Thuộc thành phố</th><td>{!! $quan->thanhpho->title !!}</td></tr>
            <tr><th>Created At</th><td><p class="c_timezone">{{ $quan->created_at }}</p></td></tr>
            <tr><th>Updated At</th><td><p class="c_timezone">{{ $quan->updated_at }}</p></td></tr>
        </tbody>
    </table>

@endsection

@push('scripts')

@endpush
