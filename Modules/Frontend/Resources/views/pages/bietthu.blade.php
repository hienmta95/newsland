@extends('frontend::master')

@section('page_title')

@endsection

@section('sliders')
    @include('frontend::pages.minislide')
@endsection

@section('styles')

@endsection

@section('content')

    <div class="breadcrumb">
        <ul class="uk-breadcrumb">
            <li><a href="{{ route('homepage') }}" title=""><i class="fa fa-home"></i> Trang chủ</a></li>
            <li><a href="{{ route('theloai', ['id'=>$item['theloai']['id'], 'slug'=>$item['theloai']['slug']]) }}" title="{{ $item['theloai']['title'] }}">{{ $item['theloai']['title'] }}</a></li>
            <li><a href="#" title="{{ $item['title'] }}">{{ $item['title'] }}</a></li>
        </ul>
    </div><!-- .breadcrumb -->

    <section class="prd-detail">
        <header class="panel-head">
            <div class="prd-information">
                <h1 class="prd-title"><span>{{ $item['title'] }}</span></h1>
                <div class="prd-price"><span class="label">Giá: </span> <span class="value">@if(!empty($item['gia'])) {{ $item['gia'] }} @else Liên hệ @endif</span></div>
                @if(!empty($item['trangthai'] == 2))
                    <div class="prd-price"><span class="label">Trạng thái: </span> <span class="value">Đã qua sử dụng </span></div>
                @endif
                <div class="prd-desc">
                    {!! $item['mota'] !!}
                </div>
            </div>

            <div class="uk-grid uk-grid-width-large-1-2" style="padding-bottom: 20px;">
                <div class="prd-gallerys">
                    <div id="slider" class="flexslider">
                        <ul class="slides">
                            @foreach($item['images'] as $img)
                            <li>
                                <div class="thumb">
                                    <a class="image img-cover" href="{{ cxl_asset('/'). $img['url'] }}" title="Ảnh chi tiết dự án" data-uk-lightbox="{group:'prdGallerys'}"><img src="{{ cxl_asset('/'). $img['url'] }}" alt="" /></a>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div id="carousel" class="flexslider">
                        <ul class="slides">

                            @foreach($item['images'] as $img)
                            <li>
                                <div class="thumb">
                                    <span class="image img-cover"><img src="{{ cxl_asset('/'). $img['url'] }}" alt="" /></span>
                                </div>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                    <!-- Không có slide ảnh
                    <div class="cover"><a class="image img-cover" href="" title=""></a></div>
                    -->
                </div>
                <div class="register-form">
                    <div class="hotline">
                        <div class="hotline-content">
                            <p>HOTLINE</p>
                            <p><span>{{ $info['sdtcongty'] }}</span></p>
                        </div>
                    </div>
                    <div class="form">
                        <header class="panel-head">
                            <h3 class="heading-4">Đăng ký nhận tư vấn</h3>
                            <div class="description">
                                Liên hệ với chúng tôi để nhận được tư vấn ngay.
                            </div>
                        </header>
                        <section class="panel-body">
                            <form class="uk-form form" id="FormRegister" action="{{ route('post.lienhe') }}" method="post">
                                @csrf
                                <div class="form-row uk-clearfix">
                                    <label class="label">
                                        Họ tên <span class="form-require"> * </span>
                                    </label>
                                    <div class="form-input">
                                        <input type="text" name="hoten" required value="" class="input-text">
                                    </div>
                                </div>
                                <div class="form-row uk-clearfix">
                                    <label class="label">
                                        Phone <span class="form-require"> * </span>
                                    </label>
                                    <div class="form-input">
                                        <input type="number" name="sdt" required value="" class="input-text">
                                    </div>
                                </div>
                                <div class="form-row uk-clearfix">
                                    <label class="label">
                                        Email <span class="form-require"> * </span>
                                    </label>
                                    <div class="form-input">
                                        <input type="email" name="email" required value="" class="input-text">
                                    </div>
                                </div>
                                <div class="form-row uk-clearfix">
                                    <label class="label">
                                        Nội dung quan tâm <span class="form-require"> * </span>
                                    </label>
                                    <div class="form-input">
                                        <textarea type="text" style="height: 65px;" name="noidung" required value="" class="input-text"></textarea>
                                    </div>
                                </div>
                                <input name="v-submit" class="form-submit" type="submit" value="Gửi">
                            </form>
                        </section>

                    </div>
                </div>
            </div>
        </header>
        <section class="panel-body">
            <ul class="uk-list uk-clearfix navtab" data-uk-sticky="">
                <li><a href="#chinhsach" title="">Chính sách</a></li>
                <li><a href="#content" title="">Tổng quan</a></li>
                <li><a href="#position" title="">Vị trí</a></li>
                <li><a href="#feature" title="">Tiện ích</a></li>
                <li><a href="#area" title="">Mặt bằng</a></li>
                <li><a href="#noithat" title="">Nội thất</a></li>
                <li><a href="#tiendo" title="">Tiến độ</a></li>
                <li><a href="#hinhanh" title="">Hình ảnh</a></li>
            </ul>
            <div class="prd-contents">

                @if($item['chinhsach'])
                    <div class="tab" id="chinhsach">
                    <h2>Chính sách</h2>
                    {!! $item['chinhsach'] !!}
                </div>
                @endif

                @if($item['tongquan'])
                    <div class="tab" id="content">
                        <h2>Tổng Quan</h2>
                        {!! $item['tongquan'] !!}
                    </div>
                @endif

                @if($item['vitri'])
                    <div class="tab" id="position">
                        <h2>Vị trí</h2>
                    {!! $item['vitri'] !!}
                    </div>
                @endif

                @if($item['tienich'])
                    <div class="tab" id="feature">
                        <h2>Tiện ích</h2>
                        {!! $item['tienich'] !!}
                    </div>
                @endif

                @if($item['matbang'])
                <div class="tab" id="area">
                    <h2>Mặt bằng</h2>
                    {!! $item['matbang'] !!}
                </div>
                @endif

                @if($item['noithat'])
                <div class="tab" id="noithat">
                    <h2>Nội thất</h2>
                    {!! $item['noithat'] !!}
                </div>
                @endif

                @if($item['tiendo'])
                    <div class="tab" id="tiendo">
                    <h2>Tiến độ</h2>
                    {!! $item['tiendo'] !!}
                </div>
                @endif

                @if($item['hinhanh'])
                <div class="tab" id="hinhanh">
                    <h2>Hình ảnh</h2>
                    {!! $item['hinhanh'] !!}
                </div>
                @endif

            </div>
        </section>
    </section><!-- .prd-detail -->


    <section class="prdcatalogue prdsame">
        <header class="panel-head">
            <h2 class="heading"><span>Dự án cùng danh mục</span></h2>
        </header>
        <section class="panel-body">
            <ul class="uk-grid lib-grid-20 uk-grid-width-1-2 uk-grid-width-medium-1-3 list-article" data-uk-grid-match="{target: '.article .title'}">

                @foreach($same as $item)
                <li>
                    <article class="uk-clearfix article">
                        <div class="thumb"><a class="image img-cover" href="{{ route('bietthu', ['id'=>$item['id'], 'slug'=>$item['slug']]) }}" title="{{ $item['title'] }}"><img src="{{ cxl_asset('/'). $item['image']['url'] }}" alt="{{ $item['title'] }}" /></a></div>
                        <div class="infor">
                            <h3 class="title"><a href="{{ route('bietthu', ['id'=>$item['id'], 'slug'=>$item['slug']]) }}" title="{{ $item['title'] }}">{{ $item['title'] }}</a></h3>
                            <div class="price">
                                <span class="label">Giá: </span>
                                <span class="value">
                                    @if(!empty($item['gia'])) {{ $item['gia'] }} @else Liên hệ @endif
                                </span>
                            </div>
                            <div class="description">
                                {!! $item['mota'] !!}
                            </div>
                        </div>
                    </article><!-- .article -->
                </li>
                @endforeach

            </ul>
        </section>
    </section><!-- .prdsame -->

@endsection

@section('scripts')
    <script>
        (function ( $ ) {

            $('#fixed-span').removeClass('active');
            $('#fixed-div').addClass('active');

            $('#carousel').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                itemWidth: 95,
                itemMargin: 0,
                prevText: '',
                nextText: '',
                asNavFor: '#slider'
            });
            $('#slider').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                prevText: '',
                nextText: '',
                sync: "#carousel"
            });
        })(jQuery);
    </script>
@endsection
