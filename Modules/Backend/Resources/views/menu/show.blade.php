@extends('backend::layouts.main')
@section('page_title')
Chi tiết: {{ $menu->title ? $menu->title : "" }}
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.menu.index') }}">Danh sách </a></li>
    <li class="active">{{ $menu->title ? $menu->title : "" }}</li>
</ul>
@endsection
@section('content')
    <p>
        {!! Form::open(['route'=>['backend.menu.destroy', $menu->id], 'method'=>'DELETE']) !!}
        <a class="btn btn-success" href="{{ route('backend.menu.create') }}">Create menu </a>
        <a class="btn btn-primary" href="{{ route('backend.menu.edit', $menu->id) }}">Update</a>
        {!! Form::submit('Delete',['class'=>'btn btn-danger confirm','onclick'=>'return confirm("Are you sure you want to delete this item?");']) !!}
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
            <tr><th>ID</th><td>{{ $menu->id }}</td></tr>
            <tr><th>Tiêu đề</th><td>{!! $menu->title ? $menu->title : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Link to </th><td>{!! $menu->link ? $menu->link : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Số thứ tự hiển thị </th><td>{!! $menu->order !!}</td></tr>
            <tr><th>Created At</th><td><p class="c_timezone">{{ $menu->created_at }}</p></td></tr>
            <tr><th>Updated At</th><td><p class="c_timezone">{{ $menu->updated_at }}</p></td></tr>
        </tbody>
    </table>

@endsection

@push('scripts')

@endpush
