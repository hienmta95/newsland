@extends('backend::layouts.main')
@section('page_title')
Chi tiết: {{ $thanhpho->title ? $thanhpho->title : "" }}
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.thanhpho.index') }}">Danh sách </a></li>
    <li class="active">{{ $thanhpho->title ? $thanhpho->title : "" }}</li>
</ul>
@endsection
@section('content')
    {{--<h1>{{ $thanhpho->title ? $thanhpho->title : "" }}</h1>--}}
    <p>
        {!! Form::open(['route'=>['backend.thanhpho.destroy', $thanhpho->id], 'method'=>'DELETE']) !!}
        <a class="btn btn-success" href="{{ route('backend.thanhpho.create') }}">Create thành phố</a>
        <a class="btn btn-primary" href="{{ route('backend.thanhpho.edit', $thanhpho->id) }}">Update</a>
        {!! Form::submit('Delete',['class'=>'btn btn-danger confirm','onclick'=>'return confirm("Are you sure you want to delete this item?");']) !!}
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
            <tr><th>ID</th><td>{{ $thanhpho->id }}</td></tr>
            <tr><th>Tên</th><td>{!! $thanhpho->title ? $thanhpho->title : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Tên trên url</th><td>{!! $thanhpho->slug ? $thanhpho->slug : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Thuộc miền</th><td>{!! $thanhpho->tenmien == "mienbac" ? "Miền Bắc" : ($thanhpho->tenmien == "mientrung" ? "Miền Trung" : "Miền Nam") !!}</td></tr>
            <tr><th>Created At</th><td><p class="c_timezone">{{ $thanhpho->created_at }}</p></td></tr>
            <tr><th>Updated At</th><td><p class="c_timezone">{{ $thanhpho->updated_at }}</p></td></tr>
        </tbody>
    </table>

@endsection

@push('scripts')

@endpush
