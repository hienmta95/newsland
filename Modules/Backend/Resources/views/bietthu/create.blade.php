@extends('backend::layouts.main')
@section('page_title')
Tạo mới biệt thự
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.bietthu.index') }}">Danh sách</a></li>
    <li class="active">Tạo mới sản phẩm  </li>
</ul>
@endsection
@section('content')
    {{--<h1>Create bietthu</h1>--}}
    <div class="sp-push-form">
        <form id="bietthu_create" action="{{ route('backend.bietthu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group @if (count($errors->all())) {{$errors->has(['title']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Tiêu đề sản phẩm <span class="required">*</span></label>
                <input type="text" class="form-control{{ $errors->has('title') ? ' has-error' : '' }}" name="title" value="{{ old('title') }}">
                <div class="help-block">@if($errors->has('title')) {{ $errors->first('title') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['slug']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Tên hiển thị trên link <span class="required">*</span></label>
                <input type="text" class="form-control{{ $errors->has('slug') ? ' has-error' : '' }}" name="slug" value="{{ old('slug') }}" placeholder="news-land-slug">
                <div class="help-block">@if($errors->has('slug')) {{ $errors->first('slug') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['quan_id']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Chọn quận <span class="required">*</span></label>
                <select class="form-control selectpicker" data-live-search="true" name="quan_id">
                    <option value="">Chọn</option>
                    @foreach ($quan as $item)
                        <option value="{{ $item->id }}" {{ old('quan_id')==$item->id ? "selected" : "" }}>{{ $item->title }}</option>
                    @endforeach
                </select>
                <div class="help-block">@if($errors->has('quan_id')) {{ $errors->first('quan_id') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['theloai_id']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Chọn thể loại <span class="required">*</span></label>
                <select class="form-control selectpicker" data-live-search="true" name="theloai_id">
                    <option value="">Chọn</option>
                    @foreach ($theloai as $item)
                        <option value="{{ $item->id }}" {{ old('theloai_id')==$item->id ? "selected" : "" }}>{{ $item->title }}</option>
                    @endforeach
                </select>
                <div class="help-block">@if($errors->has('theloai_id')) {{ $errors->first('theloai_id') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['gia']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Giá </label>
                <input type="text" class="form-control{{ $errors->has('gia') ? ' has-error' : '' }}" name="gia" value="{{ old('gia') }}">
                <div class="help-block">@if($errors->has('gia')) {{ $errors->first('gia') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['trangthai']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Trạng thái </label>
                <div>
                    <label class="radio-inline"><input type="radio" name="trangthai" value="1" @if(old('trangthai') == 1) {!! 'checked'!!} @endif ><strong>Chưa qua sử dụng</strong></label>
                    <label class="radio-inline"><input type="radio" name="trangthai" value="2" @if(old('trangthai') == 2) {!! 'checked'!!} @endif ><strong>Đã qua sử dụng</strong></label>
                    <label class="radio-inline"><input type="radio" name="trangthai" value="0" @if(old('trangthai') == 0) {!! 'checked'!!} @endif ><strong>Không xác định</strong></label>
                </div>
                <div class="help-block">@if($errors->has('trangthai')) {{ $errors->first('trangthai') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['mota']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Mô tả <span class="required">*</span></label>
                <textarea id="mota" class="form-control{{ $errors->has('mota') ? ' has-error' : '' }}" name="mota" maxlength="255" rows="3">{{ old('mota') }}</textarea>
                <script type="text/javascript">
                    var mota = CKEDITOR.replace('mota',{});
                </script>
                <div class="help-block">@if($errors->has('mota')) {{ $errors->first('mota') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['chinhsach']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Chính sách </label>
                <textarea id="chinhsach" class="form-control{{ $errors->has('chinhsach') ? ' has-error' : '' }}" name="chinhsach" maxlength="255" rows="3">{{ old('chinhsach') }}</textarea>
                <script type="text/javascript">
                    var editor = CKEDITOR.replace('chinhsach',{
                        language:'vi',
                        filebrowserBrowseUrl :'/js/ckfinder/ckfinder.html',
                        filebrowserImageBrowseUrl : '/js/ckfinder/ckfinder.html?type=Images',
                        filebrowserFlashBrowseUrl : '/js/ckfinder/ckfinder.html?type=Flash',
                        filebrowserUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                        filebrowserImageUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                        filebrowserFlashUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                    });
                </script>
                <div class="help-block">@if($errors->has('chinhsach')) {{ $errors->first('chinhsach') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['tongquan']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Tổng quan </label>
                <textarea id="tongquan" class="form-control{{ $errors->has('tongquan') ? ' has-error' : '' }}" name="tongquan" maxlength="255" rows="3">{{ old('tongquan') }}</textarea>
                <script type="text/javascript">
                    var tongquan = CKEDITOR.replace('tongquan',{
                        language:'vi',
                        filebrowserBrowseUrl :'/js/ckfinder/ckfinder.html',
                        filebrowserImageBrowseUrl : '/js/ckfinder/ckfinder.html?type=Images',
                        filebrowserFlashBrowseUrl : '/js/ckfinder/ckfinder.html?type=Flash',
                        filebrowserUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                        filebrowserImageUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                        filebrowserFlashUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                    });
                </script>
                <div class="help-block">@if($errors->has('tongquan')) {{ $errors->first('tongquan') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['vitri']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Vị trí </label>
                <textarea id="vitri" class="form-control{{ $errors->has('vitri') ? ' has-error' : '' }}" name="vitri" maxlength="255" rows="3">{{ old('vitri') }}</textarea>
                <script type="text/javascript">
                    var vitri = CKEDITOR.replace('vitri',{
                        language:'vi',
                        filebrowserBrowseUrl :'/js/ckfinder/ckfinder.html',
                        filebrowserImageBrowseUrl : '/js/ckfinder/ckfinder.html?type=Images',
                        filebrowserFlashBrowseUrl : '/js/ckfinder/ckfinder.html?type=Flash',
                        filebrowserUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                        filebrowserImageUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                        filebrowserFlashUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                    });
                </script>
                <div class="help-block">@if($errors->has('vitri')) {{ $errors->first('vitri') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['tienich']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Tiện ích </label>
                <textarea id="tienich" class="form-control{{ $errors->has('tienich') ? ' has-error' : '' }}" name="tienich" maxlength="255" rows="3">{{ old('tienich') }}</textarea>
                <script type="text/javascript">
                    var tienich = CKEDITOR.replace('tienich',{
                        language:'vi',
                        filebrowserBrowseUrl :'/js/ckfinder/ckfinder.html',
                        filebrowserImageBrowseUrl : '/js/ckfinder/ckfinder.html?type=Images',
                        filebrowserFlashBrowseUrl : '/js/ckfinder/ckfinder.html?type=Flash',
                        filebrowserUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                        filebrowserImageUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                        filebrowserFlashUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                    });
                </script>
                <div class="help-block">@if($errors->has('tienich')) {{ $errors->first('tienich') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['matbang']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Mặt bằng </label>
                <textarea id="matbang" class="form-control{{ $errors->has('matbang') ? ' has-error' : '' }}" name="matbang" maxlength="255" rows="3">{{ old('matbang') }}</textarea>
                <script type="text/javascript">
                    var matbang = CKEDITOR.replace('matbang',{
                        language:'vi',
                        filebrowserBrowseUrl :'/js/ckfinder/ckfinder.html',
                        filebrowserImageBrowseUrl : '/js/ckfinder/ckfinder.html?type=Images',
                        filebrowserFlashBrowseUrl : '/js/ckfinder/ckfinder.html?type=Flash',
                        filebrowserUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                        filebrowserImageUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                        filebrowserFlashUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                    });
                </script>
                <div class="help-block">@if($errors->has('matbang')) {{ $errors->first('matbang') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['noithat']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Nội thất </label>
                <textarea id="noithat" class="form-control{{ $errors->has('noithat') ? ' has-error' : '' }}" name="noithat" maxlength="255" rows="3">{{ old('noithat') }}</textarea>
                <script type="text/javascript">
                    var noithat = CKEDITOR.replace('noithat',{
                        language:'vi',
                        filebrowserBrowseUrl :'/js/ckfinder/ckfinder.html',
                        filebrowserImageBrowseUrl : '/js/ckfinder/ckfinder.html?type=Images',
                        filebrowserFlashBrowseUrl : '/js/ckfinder/ckfinder.html?type=Flash',
                        filebrowserUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                        filebrowserImageUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                        filebrowserFlashUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                    });
                </script>
                <div class="help-block">@if($errors->has('noithat')) {{ $errors->first('noithat') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['tiendo']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Tiến độ </label>
                <textarea id="tiendo" class="form-control{{ $errors->has('tiendo') ? ' has-error' : '' }}" name="tiendo" maxlength="255" rows="3">{{ old('tiendo') }}</textarea>
                <script type="text/javascript">
                    var tiendo = CKEDITOR.replace('tiendo',{
                        language:'vi',
                        filebrowserBrowseUrl :'/js/ckfinder/ckfinder.html',
                        filebrowserImageBrowseUrl : '/js/ckfinder/ckfinder.html?type=Images',
                        filebrowserFlashBrowseUrl : '/js/ckfinder/ckfinder.html?type=Flash',
                        filebrowserUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                        filebrowserImageUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                        filebrowserFlashUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                    });
                </script>
                <div class="help-block">@if($errors->has('tiendo')) {{ $errors->first('tiendo') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['hinhanh']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Hình ảnh </label>
                <textarea id="hinhanh" class="form-control{{ $errors->has('hinhanh') ? ' has-error' : '' }}" name="hinhanh" maxlength="255" rows="3">{{ old('hinhanh') }}</textarea>
                <script type="text/javascript">
                    var hinhanh = CKEDITOR.replace('hinhanh',{
                        language:'vi',
                        filebrowserBrowseUrl :'/js/ckfinder/ckfinder.html',
                        filebrowserImageBrowseUrl : '/js/ckfinder/ckfinder.html?type=Images',
                        filebrowserFlashBrowseUrl : '/js/ckfinder/ckfinder.html?type=Flash',
                        filebrowserUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                        filebrowserImageUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                        filebrowserFlashUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                    });
                </script>
                <div class="help-block">@if($errors->has('hinhanh')) {{ $errors->first('hinhanh') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['image']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Hình ảnh thumbnail <span class="required">*</span></label>
                <input id="input-b1" name="image" type="file" class="file" accept=".jpg,.gif,.png,.jpeg">
                <div class="help-block">@if($errors->has('image')) {{ $errors->first('image') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['images']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Hình ảnh dự án <span class="required">*</span></label>
                <input id="input-24" name="images[]" type="file" multiple>
                <div class="help-block">@if($errors->has('images')) {{ $errors->first('images') }} @endif</div>
            </div>

            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Lưu</button>
            </div>

        </form>
    </div>

@endsection

@push('scripts')

    <link rel="stylesheet" href="<?php echo asset('backend/bower_components/bootstrap-fileinput/css/fileinput.css')?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('backend/bower_components/bootstrap-fileinput/css/fileinput-rtl.css')?>" type="text/css">

    <script src="{!! asset('backend/bower_components/bootstrap-fileinput/js/plugins/piexif.js') !!}"></script>
    <script src="{!! asset('backend/bower_components/bootstrap-fileinput/js/plugins/sortable.js') !!}"></script>
    <script src="{!! asset('backend/bower_components/bootstrap-fileinput/js/plugins/purify.js') !!}"></script>
    <script src="{!! asset('backend/bower_components/bootstrap-fileinput/js/fileinput.js') !!}"></script>

    <script>
        $(document).on('ready', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#input-24").fileinput({
                // uploadUrl: "/upload",
                maxFileCount: 10,
                validateInitialCount: true,
                overwriteInitial: false,
                allowedFileExtensions: ["jpg", "png", "gif", "jpeg"],
                initialPreview: [
                    // "<img class='kv-preview-data file-preview-image' src='https://placeimg.com/800/460/nature'>",
                    // "<img class='kv-preview-data file-preview-image' src='https://placeimg.com/800/460/nature'>",
                ],
                initialPreviewConfig: [
                    // {caption: "Nature-1.jpg", size: 628782, width: "120px", url: "/admin/image/delete", key: 1},
                    // {caption: "Nature-2.jpg", size: 982873, width: "120px", url: "/admin/image/delete", key: 2},
                ],
            });
        });
    </script>

@endpush
