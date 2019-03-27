@extends('backend::layouts.main')
@section('page_title')
Chi tiết: {{ $minislide->title ? $minislide->title : "" }}
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.minislide.index') }}">Danh sách </a></li>
    <li class="active">{{ $minislide->title ? $minislide->title : "" }}</li>
</ul>
@endsection
@section('content')
    <p>
        {!! Form::open(['route'=>['backend.minislide.destroy', $minislide->id], 'method'=>'DELETE']) !!}
        <a class="btn btn-success" href="{{ route('backend.minislide.create') }}">Create mini slide</a>
        <a class="btn btn-primary" href="{{ route('backend.minislide.edit', $minislide->id) }}">Update</a>
        {!! Form::submit('Delete',['class'=>'btn btn-danger confirm','onclick'=>'return confirm("Are you sure you want to delete this item?");']) !!}
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
            <tr><th>Image</th><td>{!! $minislide->image ? "<img  class='show-images' src='".asset('/').$minislide->image->url."' alt=''>" : "<span class='not-set'>(not set)</span>"!!}</td></tr>
            <tr><th>ID</th><td>{{ $minislide->id }}</td></tr>
            <tr><th>Tiêu đề</th><td>{!! $minislide->title ? $minislide->title : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Link to</th><td>{!! $minislide->link ? $minislide->link : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Created At</th><td><p class="c_timezone">{{ $minislide->created_at }}</p></td></tr>
            <tr><th>Updated At</th><td><p class="c_timezone">{{ $minislide->updated_at }}</p></td></tr>
        </tbody>
    </table>

@endsection

@push('scripts')

@endpush
