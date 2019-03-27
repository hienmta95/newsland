@extends('backend::layouts.main')
@section('page_title')
{{ $bietthu->title ? $bietthu->title : "" }}
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.bietthu.index') }}">Danh sách</a></li>
    <li class="active">{{ $bietthu->title ? $bietthu->title : "" }}</li>
</ul>
@endsection
@section('content')
    <p>
        {!! Form::open(['route'=>['backend.bietthu.destroy', $bietthu->id], 'method'=>'DELETE']) !!}
        <a class="btn btn-success" href="{{ route('backend.bietthu.create') }}">Tạo mới</a>
        <a class="btn btn-primary" href="{{ route('backend.bietthu.edit', $bietthu->id) }}">Sửa</a>
        {!! Form::submit('Xoá',['class'=>'btn btn-danger confirm','onclick'=>'return confirm("Are you sure you want to delete this item?");']) !!}
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
            <tr><th>ID</th><td>{{ $bietthu->id }}</td></tr>
            <tr><th>Tiêu đề</th><td>{{ $bietthu->title }}</td></tr>
            <tr><th>Slug</th><td>{!! $bietthu->slug ? $bietthu->slug : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Thuộc thể loại</th><td>{{ $bietthu->theloai->title }}</td></tr>
            <tr><th>Thuộc thành phố</th><td>{{ $bietthu->quan->thanhpho->title }}</td></tr>
            <tr><th>Thuộc quận</th><td>{{ $bietthu->quan->title }}</td></tr>
            <tr><th>Giá </th><td>{!! $bietthu->gia ? $bietthu->gia : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Mô tả </th><td>{!! $bietthu->mota ? mb_convert_encoding(substr($bietthu->mota, 0, 100), 'UTF-8', 'UTF-8') : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Chính sách </th><td>{!! $bietthu->chinhsach ? mb_convert_encoding(substr($bietthu->chinhsach, 0, 100), 'UTF-8', 'UTF-8') : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Tổng quan </th><td>{!! $bietthu->tongquan ? mb_convert_encoding(substr($bietthu->tongquan, 0, 100), 'UTF-8', 'UTF-8') : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Vị trí </th><td>{!! $bietthu->vitri ? mb_convert_encoding(substr($bietthu->vitri, 0, 100), 'UTF-8', 'UTF-8') : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Tiện ích </th><td>{!! $bietthu->tienich ? mb_convert_encoding(substr($bietthu->tienich, 0, 100), 'UTF-8', 'UTF-8') : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Mặt bằng </th><td>{!! $bietthu->matbang ? mb_convert_encoding(substr($bietthu->matbang, 0, 100), 'UTF-8', 'UTF-8') : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Nội thất </th><td>{!! $bietthu->noithat ? mb_convert_encoding(substr($bietthu->noithat, 0, 100), 'UTF-8', 'UTF-8') : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Tiến độ </th><td>{!! $bietthu->tiendo ? mb_convert_encoding(substr($bietthu->tiendo, 0, 100), 'UTF-8', 'UTF-8') : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Hình ảnh </th><td>{!! $bietthu->hinhanh ? mb_convert_encoding(substr($bietthu->hinhanh, 0, 100), 'UTF-8', 'UTF-8') : "<span class='not-set'>(not set)</span>"  !!}</td></tr>

            <tr><th>Trạng thái</th><td>{{ $bietthu->trangthai == '2' ? 'Đã qua sử dụng' : ($bietthu->trangthai == '1' ? 'Chưa qua sử dụng' : ' - ' ) }}</td></tr>
            <tr><th>Ngày tạo</th><td><p class="c_timezone">{{ $bietthu->created_at }}</p></td></tr>
            <tr><th>Ngày sửa</th><td><p class="c_timezone">{{ $bietthu->updated_at }}</p></td></tr>
            <tr><th>Hình ảnh thumbnail </th><td>{!! $bietthu->image ? "<img  class='show-images' src='".asset('/'). $bietthu->image->url ."' alt=''>" : "<span class='not-set'>(not set)</span>"!!}</td></tr>

            <tr><th>Hình ảnh dự án</th>
                <td>
                    @foreach($bietthu->images as $img)
                        <span class="image-list"><img src="{{ asset('/').$img->url }}" /></span>
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>

@endsection

@push('css')
    <style>
        .image-list {
            max-width: 160px;
            margin: 5px;
            display: inline-block;
        }
        .image-list img{
            width: 100%;
        }
    </style>
@endpush

@push('scripts')

@endpush
