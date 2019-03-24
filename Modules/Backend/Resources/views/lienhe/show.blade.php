@extends('backend::layouts.main')
@section('page_title')
{{ $lienhe->hoten ? $lienhe->hoten : "" }}
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.lienhe.index') }}">Danh sách</a></li>
    <li class="active">{{ $lienhe->hoten ? $lienhe->hoten : "" }}</li>
</ul>
@endsection
@section('content')
{{--    <h1>{{ $lienhe->title ? $lienhe->title : "" }}</h1>--}}
    <p>
        {!! Form::open(['route'=>['backend.lienhe.destroy', $lienhe->id], 'method'=>'DELETE']) !!}
{{--        <a class="btn btn-success" href="{{ route('backend.lienhe.create') }}">Tạo mới</a>--}}
        <a class="btn btn-primary" href="{{ route('backend.lienhe.edit', $lienhe->id) }}">Sửa</a>
        {!! Form::submit('Xoá',['class'=>'btn btn-danger confirm','onclick'=>'return confirm("Are you sure you want to delete this item?");']) !!}
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
            <tr><th>ID</th><td>{{ $lienhe->id }}</td></tr>
            <tr><th>Họ tên</th><td>{!! $lienhe->hoten ? $lienhe->hoten : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Điện thoại </th><td>{!! $lienhe->dienthoai ? $lienhe->dienthoai : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Email </th><td>{!! $lienhe->email ? $lienhe->email : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Nội dung </th><td>{!! $lienhe->noidung ? $lienhe->noidung : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Trạng thái</th><td>{{ $lienhe->trangthai == 1 ? "Đã xử lý" : "Chưa xử lý" }}</td></tr>
            <tr><th>Ngày tạo</th><td><p class="c_timezone">{{ $lienhe->created_at }}</p></td></tr>
            <tr><th>Ngày sửa</th><td><p class="c_timezone">{{ $lienhe->updated_at }}</p></td></tr>
        </tbody>
    </table>

@endsection

@push('scripts')

@endpush
