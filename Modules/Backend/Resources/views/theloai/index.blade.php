@extends('backend::layouts.main')
@section('page_title')
Quản lý loại chung cư
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li class="active">Danh sách</li>
</ul>
@endsection
@section('content')
<div class="sp-push-index">
    <p>
        <a class="btn btn-success" href="{{ route('backend.theloai.create') }}">Tạo mới thể loại </a>
    </p>
    <div class="grid-view" id="w0">
        <div class="summary">
            <table class="table table-striped table-bordered table-style" id="theloai-table">
                <thead>
                    <tr>
                        <th class="un-orderable-col">#</th>
                        <th class="orderable-col">ID</th>
                        <th class="un-orderable-col">Số thứ tự hiện thị</th>
                        <th class="un-orderable-col">Tiêu đề</th>
                        <th class="un-orderable-col">Tên trên URL</th>
                        <th class="orderable-col">Ngày tạo</th>
                        <th class="un-orderable-col">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    var table = $('#theloai-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: true,
        pageLength: 20,
        lengthChange: false,
        lengthMenu: [10, 20, 50, 100],
        ajax: '{!! route('backend.theloai.indexData') !!}',
        dom: '<"top"i>rt<"bottom"p><"clear">',
        order: [ [2, "asc"] ],
        language: {
            paginate: {
                previous: "«",
                next: "»"
            }
        },
        columns: [
            {data: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'id', name: 'id'},
            {data: 'order', name: 'order'},
            {data: 'title', name: 'title', orderable: false},
            {data: 'slug', name: 'slug', orderable: false},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        "initComplete": function () {
            $('#theloai-table_paginate').css({"float": "left"});
            var r = $('#theloai-table tfoot tr');
            $('#theloai-table thead').append(r);
            this.api().columns().every(function (i) {
                if (i != 0 && i != 6 && i != 9  && i != 1) {
                    var column = this;
                    var table = $('#theloai-table').DataTable();
                    var input = document.createElement("input");
                    input.className = "form-control";
                    $(input).appendTo($(column.footer()).empty())
                        .on('change', function () {
                            column.search($(this).val() ? $(this).val() : '', false, false,true).draw();
                        });
                    $('#theloai-table thead tr th input').css({"width": "100%", "margin": "0px 0px 0px 0px"});
                }
            });

        },
    });
</script>
@endpush
