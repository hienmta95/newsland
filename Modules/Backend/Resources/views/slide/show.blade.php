@extends('backend::layouts.main')
@section('page_title')
Chi tiết: {{ $slide->title ? $slide->title : "" }}
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.slide.index') }}">Danh sách </a></li>
    <li class="active">{{ $slide->title ? $slide->title : "" }}</li>
</ul>
@endsection
@section('content')
    {{--<h1>{{ $slide->title ? $slide->title : "" }}</h1>--}}
    <p>
        {!! Form::open(['route'=>['backend.slide.destroy', $slide->id], 'method'=>'DELETE']) !!}
        <a class="btn btn-success" href="{{ route('backend.slide.create') }}">Create slide</a>
        <a class="btn btn-primary" href="{{ route('backend.slide.edit', $slide->id) }}">Update</a>
        {!! Form::submit('Delete',['class'=>'btn btn-danger confirm','onclick'=>'return confirm("Are you sure you want to delete this item?");']) !!}
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
            <tr><th>Image</th><td>{!! $slide->image ? "<img  class='show-images' src='".asset('/').$slide->image->url."' alt=''>" : "<span class='not-set'>(not set)</span>"!!}</td></tr>
            <tr><th>ID</th><td>{{ $slide->id }}</td></tr>
            <tr><th>Tiêu đề</th><td>{!! $slide->title ? $slide->title : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Link to</th><td>{!! $slide->link ? $slide->link : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Created At</th><td><p class="c_timezone">{{ $slide->created_at }}</p></td></tr>
            <tr><th>Updated At</th><td><p class="c_timezone">{{ $slide->updated_at }}</p></td></tr>
        </tbody>
    </table>

@endsection

@push('scripts')

@endpush
