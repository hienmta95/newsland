@extends('backend::layouts.main')
@section('page_title')
Update thông tin
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li class="active">Update thông tin</li>
</ul>
@endsection
@section('content')
    <h1>Update thông tin website.</h1>
    <div class="sp-push-form">
        <form action="{{ route('backend.thongtin.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group  @if (count($errors->all())) {{$errors->has(['tencongty']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Tên công ty<span class="required">*</span></label>
                <input class="form-control{{ $errors->has('tencongty') ? ' has-error' : '' }}" name="tencongty" type="text" value="{{ $info->tencongty }}">
                <div class="help-block">@if($errors->has('tencongty')) {{ $errors->first('tencongty') }} @endif</div>
            </div>

            <div class="form-group  @if (count($errors->all())) {{$errors->has(['emailcongty']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Email công ty<span class="required">*</span></label>
                <input class="form-control{{ $errors->has('emailcongty') ? ' has-error' : '' }}" name="emailcongty" type="text" value="{{ $info->emailcongty }}">
                <div class="help-block">@if($errors->has('emailcongty')) {{ $errors->first('emailcongty') }} @endif</div>
            </div>

            <div class="form-group  @if (count($errors->all())) {{$errors->has(['diachicongty']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Địa chỉ trụ sở<span class="required">*</span></label>
                <input class="form-control{{ $errors->has('diachicongty') ? ' has-error' : '' }}" name="diachicongty" type="text" value="{{ $info->diachicongty }}">
                <div class="help-block">@if($errors->has('diachicongty')) {{ $errors->first('diachicongty') }} @endif</div>
            </div>

            <div class="form-group  @if (count($errors->all())) {{$errors->has(['sdtcongty']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">SĐT <span class="required">*</span></label>
                <input class="form-control{{ $errors->has('sdtcongty') ? ' has-error' : '' }}" name="sdtcongty" type="text" value="{{ $info->sdtcongty }}">
                <div class="help-block">@if($errors->has('sdtcongty')) {{ $errors->first('sdtcongty') }} @endif</div>
            </div>

            <div class="form-group  @if (count($errors->all())) {{$errors->has(['facebook']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Facebook</label>
                <input class="form-control{{ $errors->has('facebook') ? ' has-error' : '' }}" name="facebook" type="text" value="{{ $info->facebook }}">
                <div class="help-block">@if($errors->has('facebook')) {{ $errors->first('facebook') }} @endif</div>
            </div>

            <div class="form-group  @if (count($errors->all())) {{$errors->has(['youtube']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Youtube</label>
                <input class="form-control{{ $errors->has('youtube') ? ' has-error' : '' }}" name="youtube" type="text" value="{{ $info->youtube }}">
                <div class="help-block">@if($errors->has('youtube')) {{ $errors->first('youtube') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['image']) ? 'has-error' : 'has-success'}} @endif">
                <div>
                    <img class="show-images"  class="img-thumbnail" src="{!! $info->image ? asset('/').$info->image->url : ""!!}" alt="web_image" title="image">
                </div>
                <label class="control-label">Banner footer </label>
                <input type="hidden" name="image_old" value="{{ $info->banner_footer  }}">
                <input id="input-b1" name="image" type="file" class="file" accept=".jpg,.gif,.png,.jpeg">
                <div class="help-block">@if($errors->has('image')) {{ $errors->first('image') }} @endif</div>
            </div>

            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>

@endsection

@push('scripts')
    <link rel="stylesheet" href="<?php echo asset('backend/bower_components/bootstrap-fileinput/css/fileinput.css')?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('backend/bower_components/bootstrap-fileinput/css/fileinput-rtl.css')?>" type="text/css">
    <script src="{!! asset('backend/bower_components/bootstrap-fileinput/js/plugins/piexif.js') !!}"></script>
    <script src="{!! asset('backend/bower_components/bootstrap-fileinput/js/fileinput.js') !!}"></script>
@endpush
