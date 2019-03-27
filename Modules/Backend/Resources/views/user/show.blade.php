@extends('backend::layouts.main')
@section('page_title')
Chi tiết: {{ $user->name ? $user->name : "" }}
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.user.index') }}">Danh sách</a></li>
    <li class="active">{{ $user->username ? $user->username : "" }}</li>
</ul>
@endsection
@section('content')
    <h1>{{ $user->username ? $user->username : "" }}</h1>
    <p>
        {!! Form::open(['route'=>['backend.user.destroy', $user->id], 'method'=>'DELETE']) !!}
        <a class="btn btn-success" href="{{ route('backend.user.create') }}">Tạo mới</a>
        <a class="btn btn-primary" href="{{ route('backend.user.edit', $user->id) }}">Sửa</a>
        {!! Form::submit('Xoá',['class'=>'btn btn-danger confirm','onclick'=>'return confirm("Are you sure you want to delete this item?");']) !!}
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
            <tr><th>ID</th><td>{{ $user->id }}</td></tr>
            <tr><th>Name</th><td>{{ $user->username }}</td></tr>
            <tr><th>Email</th><td>{!! $user->email ? $user->email : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>SĐT</th><td>{!! $user->phone ? $user->phone : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Ngày tạo</th><td><p class="c_timezone">{{ $user->created_at }}</p></td></tr>
            <tr><th>Ngày sửa</th><td><p class="c_timezone">{{ $user->updated_at }}</p></td></tr>
        </tbody>
    </table>

@endsection

@push('scripts')

@endpush
