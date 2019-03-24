<!DOCTYPE html>
<html lang="vi-VN" prefix="og: http://ogp.me/ns#">
<head>
    <base href="{{ route('homepage') }}" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="alternate" href="{{ route('homepage') }}" hreflang="vi-vn" />
    <meta name="robots" content="index,follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Nhà giá tốt" />
    <meta name="copyright" content="Nhà giá tốt" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta http-equiv="refresh" content="1800" />
    <!-- for Google -->
    <title>
        @yield('page_title')
    </title>

    <meta name="keywords" content="Bất động sản Việt Nam" />
    <meta name="description" content="Trang thông tin nhà đất uy tín nhất Việt Nam. Cung cấp các sản phẩm biệt thự liền kề, nhà phố thương mại,biệt thự biển, căn hộ chung cư, condotel, hometel, thổ cư ... tại Việt Nam." />
    <link rel="canonical" href="{{ route('homepage') }}" />
    <!-- for Facebook -->
    <meta property="og:title" content="Trang thông tin nhà đất uy tín nhất Việt Nam" />
    <meta property="og:type" content="article" />
    <meta property="og:image" content="{{ asset('/images/vinhomecentralpark.jpg') }}" />
    <meta property="og:url" content="{{ route('homepage') }}" />
    <meta property="og:description" content="Trang thông tin nhà đất uy tín nhất Việt Nam. Cung cấp các sản phẩm biệt thự liền kề, nhà phố thương mại,biệt thự biển, căn hộ chung cư, condotel, hometel, thổ cư ... tại Việt Nam." />
    <meta property="og:site_name" content="Nhà giá tốt" />
    <meta property="fb:admins" content=""/>
    <meta property="fb:app_id" content="" />

    <!-- for Twitter -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="Trang thông tin nhà đất uy tín nhất Việt Nam" />
    <meta name="twitter:description" content="Trang thông tin nhà đất uy tín nhất Việt Nam. Cung cấp các sản phẩm biệt thự liền kề, nhà phố thương mại,biệt thự biển, căn hộ chung cư, condotel, hometel, thổ cư ... tại Việt Nam." />
    <meta name="twitter:image" content="{{ asset('/images/vinhomecentralpark.jpg') }}" />

    <link rel="icon" href="{{ asset('/images/favicon.ico') }}" sizes="30x30">
    <link href="{{ asset('/frontend/css/core.css') }}" rel="stylesheet" />
    <link href="{{ asset('/frontend/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/frontend/css/uikit.modify.css') }}" rel="stylesheet" />
    <link href="{{ asset('/frontend/css/reset.css') }}" rel="stylesheet" />
    <link href="{{ asset('/frontend/css/library.css') }}" rel="stylesheet" />
    <link href="{{ asset('/frontend/css/flexslider.css') }}" rel="stylesheet" />
    <link href="{{ asset('/frontend/css/jquery.fancybox.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('/frontend/css/style.css') }}" rel="stylesheet" />
    <script src="{{ asset('/frontend/js/jquery.js') }}"></script>
    <script src="{{ asset('/frontend/js/uikit.min.js') }}"></script>

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

    <script type="text/javascript">
        var BASE_URL = '{{ route('homepage') }}';
    </script>

    @yield('styles')

</head>
<body>

<!-- PC HEADER -->
<header class="pc-header uk-visible-large">
    <section class="upper" data-uk-sticky="">
        <div class="uk-container uk-container-center">
            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                <!-- Các trang về tour dung logo-1.png -->
                <h1 class="logo">
                    <a href="{{ route('homepage') }}" title="Trang thông tin nhà đất uy tín nhất Việt Nam"><img src="{{ asset('/images/newsland.jpg') }}" alt="Trang thông tin nhà đất uy tín nhất Việt Nam" />
                    </a>
                    <span class="uk-hidden">Trang thông tin nhà đất uy tín nhất Việt Nam</span>
                </h1>
                <div class="logo uk-hidden">
                    <a href="{{ route('homepage') }}" title="Trang thông tin nhà đất uy tín nhất Việt Nam"><img src="{{ asset('/images/newsland.jpg') }}" alt="Trang thông tin nhà đất uy tín nhất Việt Nam" /></a>
                </div>

<!--                --><?php //var_dump($menuList); ?>

                <nav class="main-nav">
                    <ul class="uk-navbar-nav uk-clearfix main-menu">
                        @foreach($menuList as $item)
                        <li>
                            @if($item['id'] == 4)
                                <a href="#" title="{{ $item['title'] }}">{{ $item['title'] }}</a>
                                <div class="megamenu">
                                    <div class="uk-grid uk-grid-medium uk-grid-width-1-4">
                                        @foreach($thanhpho as $tinhthanh)
                                            @if($tinhthanh['tenmien'] == 'mienbac')

                                                <div class="box">
                                                    <h3 class="title"><a href="{{ route('thanhpho', ['id'=>$tinhthanh['id'], 'slug'=>$tinhthanh['slug']]) }}" title="{{ $tinhthanh['title'] }}">{{ $tinhthanh['title'] }}</a></h3>
                                                    @if(count($tinhthanh['quan']) > 0)
                                                        <ul class="uk-list submenu">

                                                            @foreach($tinhthanh['quan'] as $quanhuyen)
                                                                <li><a href="{{ route('quanhuyen', ['id'=>$quanhuyen['id'], 'slug'=>$quanhuyen['slug']]) }}" title="{{ $quanhuyen['title'] }}">{{ $quanhuyen['title'] }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>

                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @elseif($item['id'] == 5)
                                <a href="#" title="{{ $item['title'] }}">{{ $item['title'] }}</a>
                                <div class="megamenu">
                                    <div class="uk-grid uk-grid-medium uk-grid-width-1-4">
                                        @foreach($thanhpho as $tinhthanh)
                                            @if($tinhthanh['tenmien'] == 'mientrung')

                                                <div class="box">
                                                    <h3 class="title"><a href="{{ route('thanhpho', ['id'=>$tinhthanh['id'], 'slug'=>$tinhthanh['slug']]) }}" title="{{ $tinhthanh['title'] }}">{{ $tinhthanh['title'] }}</a></h3>
                                                    @if(count($tinhthanh['quan']) > 0)
                                                        <ul class="uk-list submenu">

                                                            @foreach($tinhthanh['quan'] as $quanhuyen)
                                                                <li><a href="{{ route('quanhuyen', ['id'=>$quanhuyen['id'], 'slug'=>$quanhuyen['slug']]) }}" title="{{ $quanhuyen['title'] }}">{{ $quanhuyen['title'] }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>

                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @elseif($item['id'] == 6)
                                <a href="#" title="{{ $item['title'] }}">{{ $item['title'] }}</a>
                                <div class="megamenu">
                                    <div class="uk-grid uk-grid-medium uk-grid-width-1-4">
                                        @foreach($thanhpho as $tinhthanh)
                                            @if($tinhthanh['tenmien'] == 'miennam')

                                                <div class="box">
                                                    <h3 class="title"><a href="{{ route('thanhpho', ['id'=>$tinhthanh['id'], 'slug'=>$tinhthanh['slug']]) }}" title="{{ $tinhthanh['title'] }}">{{ $tinhthanh['title'] }}</a></h3>
                                                    @if(count($tinhthanh['quan']) > 0)
                                                        <ul class="uk-list submenu">

                                                            @foreach($tinhthanh['quan'] as $quanhuyen)
                                                                <li><a href="{{ route('quanhuyen', ['id'=>$quanhuyen['id'], 'slug'=>$quanhuyen['slug']]) }}" title="{{ $quanhuyen['title'] }}">{{ $quanhuyen['title'] }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>

                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <a href="@if($item['link']){{ $item['link'] }}@else#@endif" title="{{ $item['title'] }}">{{ $item['title'] }}</a>
                            @endif

                        </li>
                        @endforeach

                    </ul>
                </nav>
            </div>
        </div>
    </section>
</header><!-- .pc-header -->

<!-- Mobile header -->
<header class="mobile-header uk-hidden-large">
    <section class="upper">
        <a class="moblie-menu-btn skin-1" href="#offcanvas" class="offcanvas" data-uk-offcanvas="{target:'#offcanvas'}">
            <span>Menu</span>
        </a>
        <div class="logo"><a href="{{ route('homepage') }}" title=""><img src="{{ asset('/images/newsland.jpg') }}" alt="" /></a></div>
        <a id="open-featured" href="/tin-tuc.html" title="Dự án bất động sản mới nhất"><img src="{{ asset('/images/news-copy.png') }}" alt=""></a>
    </section><!-- .upper -->

    <section class="lower">
        <div class="mobile-search">
            <form action="{{ route('search') }}" method="" class="uk-form form">
                <input type="text" name="keyword" class="uk-width-1-1 input-text" placeholder="Nhập nội dung tìm kiếm ..." />
                <button type="submit" name="" value="" class="btn-submit">Tìm kiếm</button>
            </form>
        </div>
    </section><!-- .upper -->
</header><!-- .mobile-header -->


<section id="body">
    <div id="homepage" class="page-body">

        @yield('sliders')

        <div class="uk-container uk-container-center">

            @yield('content')

        </div>

    </div><!-- .page-body -->
</section><!-- #body -->

<footer class="footer" style="background: url({{ asset('/'). $info['image']['url'] }}) center no-repeat"><!-- FOOTER -->
    <section class="upper">
        <div class="uk-container uk-container-center">
            <div class="uk-grid uk-grid-medium">
                <div class="uk-width-medium-1-1 uk-width-large-1-4">
                    <section class="panel">
                        <header class="panel-head">
                            <h3 class="heading"><span>Menu</span></h3>
                        </header>
                        <section class="panel-body">
                            <ul class="uk-list site-link">

                                @foreach($menu as $item)
                                <li><a href="{{ $item['link'] }}" title="{{ $item['title'] }}">{{ $item['title'] }}</a></li>
                                @endforeach

                            </ul>
                        </section><!-- .panel-body -->
                    </section><!-- .panel -->
                </div>
                <div class="uk-width-medium-1-1 uk-width-large-1-4">
                    <section class="panel">
                        <header class="panel-head">
                            <h3 class="heading"><span>Nội thất</span></h3>
                        </header>
                        <section class="panel-body">
                            <ul class="uk-list site-link">

                                @foreach($noithat as $item)
                                <li><a href="#" title="{{ $item['title'] }}">{{ $item['title'] }}</a></li>
                                @endforeach

                            </ul>
                        </section><!-- .panel-body -->
                    </section><!-- .panel -->
                </div>

                <div class="uk-width-medium-1-2 uk-width-large-1-4">
                    <section class="panel ft-subscribe">
                        <header class="panel-head">
                            <h3 class="heading"><span>Đăng ký nhận tin</span></h3>
                        </header>
                        <section class="panel-body">
                            <div class="label">Vui lòng nhập email vào ô bên dưới để nhận tư vấn và các thông tin mới nhất từ chúng tôi.</div>
                            <form action="" method="" class="uk-form form" id="emailForm">
                                <input type="text" name="email" id="email" class="uk-width-1-1 input-text" placeholder="Điền Email của bạn">
                                <button type="submit" name="" class="btn-submit">Đăng ký</button>
                            </form>
                        </section><!-- .panel-body -->
                    </section><!-- .panel -->
                </div>

                <div class="uk-width-medium-1-1 uk-width-large-1-4">
                    <section class="panel ft-contact">
                        <header class="panel-head">
                            <h3 class="heading"><span>Thông tin liên hệ</span></h3>
                        </header>
                        <section class="panel-body">
                            <div class="brandname"><a href="" title="">{{ $info['tencongty'] }}</a></div>
                            <ul class="uk-list infor">
                                <li class="location">{{ $info['diachicongty'] }}</li>
                                <li class="hotline"><a href="tel:{{ $info['sdtcongty'] }}" title="Hotline">{{ $info['sdtcongty'] }}</a></li>
                                <li class="email"><a href="mailto:{{ $info['emailcongty'] }}" title="Email">{{ $info['emailcongty'] }}</a></li>
                            </ul>
                        </section>
                    </section><!-- .panel -->
                </div>
            </div><!-- .uk-grid -->
        </div>
    </section><!-- .upper -->
    <section class="lower">
        <div class="uk-container uk-container-center">
            <div class="ft-social">
                <ul class="uk-list uk-clearfix">
                    <li><a href="{{ $info['facebook'] }}" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="" title="Google Plus" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="" title="Rss" target="_blank"><i class="fa fa-rss"></i></a></li>
                    <li><a href="" title="Pinterest" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                </ul>
            </div>
            <div class="copyright">
                Bản quyền thuộc về <a href="{{ route('homepage') }}" title="NewslandVN">NewslandVN</a> | Copyright @ {{ date('Y') }}<br>
            </div>
        </div>
    </section>
</footer><!--.footer -->
<a id="goTop" class="goTop" href="#" title="Về đầu trang"><i class="fa fa-angle-up"></i></a>

<script type="text/javascript">
    jQuery(function($) {
        $('body').append('<a style="display:none;" class="callus" href="tel:{{ $info['sdtcongty'] }}">{{ $info['sdtcongty'] }}</a>');
        var lastScrollTop = 0;
        $(window).scroll(function(event){
            var st = $(this).scrollTop();
            if (st > lastScrollTop){
                // downscroll code
                $('a.callus').removeClass('display');
            } else {
                $('a.callus').addClass('display');
            }
            lastScrollTop = st;
        });
    });
</script>

<style type="text/css">
    a.callus {
        display: block !important;
        position: fixed;
        z-index: 9999;
        bottom: 20px;
        left: 20px;
        background: #77b63c url(http://statics.vietmoz.info/img/ico/glyphicons/earphone-white.png) no-repeat;
        background-position: 10px center;
        background-size: 20px;
        border-radius: 1000px;
        padding: 5px 10px 5px 40px;
        font-weight: 700;
        font-size: 18px;
        line-height: 30px;
        color: #fff;
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        -ms-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
        -moz-transform: scale(0);
        -webkit-transform: scale(0);
        -o-transform: scale(0);
        -ms-transform: scale(0);
        transform: scale(0);
    }
    a.display.callus {
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        -ms-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
        -moz-transform: scale(1);
        -webkit-transform: scale(1);
        -o-transform: scale(1);
        -ms-transform: scale(1);
        transform: scale(1);
    }
</style>

<span id="fixed-span" class="open-fixedform active"><i class="fa fa-envelope"></i></span>

<div id="fixed-div" class="fixed-form ">
    <div class="panel">
        <a class="close-form" href="">+</a>
        <div class="panel-body">
            <div class="vin-logo">
                <span class="image img-scaledown"><img src="{{ asset('/images/newsland.jpg') }}" alt="Logo" /></span>
            </div>
            <header class="panel-head">
                <h3 class="heading-3">Đăng ký nhận tư vấn</h3>
                <div class="description">
                    Liên hệ với chúng tôi để nhận được tư vấn ngay.
                </div>
            </header>
            <form action="{{ route('post.lienhe') }}" method="post" id="registerForm" class="uk-form form">
                @csrf
                <div class="form-row">
                    <input type="text" name="hoten" class="uk-width-1-1 input-text" placeholder="Họ tên *" />
                </div>
                <div class="form-row">
                    <input type="number" name="sdt" class="uk-width-1-1 input-text" placeholder="Số điện thoại *" />
                </div>
                <div class="form-row">
                    <input type="email" name="email" class="uk-width-1-1 input-text" placeholder="Email *" />
                </div>
                <div class="form-row">
                    <textarea type="text" name="noidung" class="uk-width-1-1 input-text">Nội dung quan tâm *</textarea>
                </div>
                <div class="form-row action">
                    <button type="submit" name="" class="btn-submit">Đăng ký</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- .fixed-form -->

{{--<script type="text/javascript">--}}
    {{--$ ('#registerForm').on('submit',function(){--}}
        {{--var postData = $(this).serializeArray(),--}}
            {{--formURL = $(this).action();--}}
        {{--$.post(formURL, {--}}
                {{--post: postData,},--}}
            {{--function(data){--}}
                {{--if(data === '1') {--}}
                    {{--alert('Đăng ký thành công, chúng tôi sẽ phản hồi trong thời gian sớm nhất.');--}}
                {{--} else {--}}
                    {{--alert('Đăng ký không thành công, xin vui lòng thử lại.');--}}
                {{--}--}}
            {{--});--}}
        {{--return false;--}}
    {{--});--}}

{{--</script>--}}

<div class="page-overlay uk-hidden-large"></div>


<!-- Dự án nổi bật mobile -->
<div class="mobile-featured-project uk-hidden-large">
    <div class="panel">
        <a id="close-fetured" class="close-fetured" href="" class=""><i class="fa fa-times-circle"></i></a>
        <div class="panel-head">
            <h2 class="heading"><span>Chung cư</span></h2>
        </div>
        <div class="panel-body">
            <ul class="uk-list uk-overflow-container list">

                @foreach($noibatMobile['bietthu'] as $item)
                <li>
                    <article class="uk-clearfix article">
                        <div class="thumb"><a class="image img-cover" href="#" title="{{ $item['title'] }}"><img src="{{ asset('/'). $item['image']['url'] }}" alt="{{ $item['title'] }}" /></a></div>
                        <div class="infor">
                            <h3 class="title"><a href="#" title="{{ $item['title'] }}">{{ $item['title'] }}</a></h3>
                            <div class="price">
                                <span class="label">Giá: </span>
                                <span class="value">
                                    @if(!empty($item['gia'])) {{ $item['gia'] }} @else Liên hệ @endif
                                </span>
                            </div>
                        </div>
                    </article><!-- .article -->
                </li>
                @endforeach

            </ul>
        </div>
    </div>
</div><!-- .mobile-featured -->
<div id="offcanvas" class="uk-offcanvas offcanvas">
    <div class="uk-offcanvas-bar">
        <form class="uk-search" action="{{ route('search') }}" data-uk-search="{}">
            <input class="uk-search-field" type="search" name="keyword" placeholder="Tìm kiếm...">
        </form>

        <ul class="l1 uk-nav uk-nav-offcanvas uk-nav uk-nav-parent-icon" data-uk-nav>
            @foreach($menuList as $item)

                @if($item['id'] == '4')
                    <li class="l1 uk-parent uk-position-relative">
                        <a href="#" title="" class="dropicon"></a>
                        <a href="#" title="Miền Bắc" class="l1">Miền Bắc</a>
                        <ul class="l2 uk-nav-sub">
                            @foreach($thanhpho as $tinhthanh)
                                @if($tinhthanh['tenmien'] == 'mienbac')
                                    <li class="l2"><a href="{{ route('thanhpho', ['id'=>$tinhthanh['id'], 'slug'=>$tinhthanh['slug']]) }}" title="{{ $tinhthanh['title'] }}" class="l2">{{ $tinhthanh['title'] }}</a></li>
                                @endif
                            @endforeach

                        </ul>
                    </li>
                @elseif($item['id'] == 5)
                    <li class="l1 uk-parent uk-position-relative">
                        <a href="#" title="" class="dropicon"></a>
                        <a href="#" title="Miền Trung" class="l1">Miền Trung</a>
                        <ul class="l2 uk-nav-sub">
                            @foreach($thanhpho as $tinhthanh)
                                @if($tinhthanh['tenmien'] == 'mientrung')
                                    <li class="l2"><a href="{{ route('thanhpho', ['id'=>$tinhthanh['id'], 'slug'=>$tinhthanh['slug']]) }}" title="{{ $tinhthanh['title'] }}" class="l2">{{ $tinhthanh['title'] }}</a></li>
                                @endif
                            @endforeach

                        </ul>
                    </li>
                @elseif($item['id'] == 6)
                    <li class="l1 uk-parent uk-position-relative">
                        <a href="#" title="" class="dropicon"></a>
                        <a href="#" title="Miền Nam" class="l1">Miền Nam</a>
                        <ul class="l2 uk-nav-sub">
                            @foreach($thanhpho as $tinhthanh)
                                @if($tinhthanh['tenmien'] == 'miennam')
                                    <li class="l2"><a href="{{ route('thanhpho', ['id'=>$tinhthanh['id'], 'slug'=>$tinhthanh['slug']]) }}" title="{{ $tinhthanh['title'] }}" class="l2">{{ $tinhthanh['title'] }}</a></li>
                                @endif
                            @endforeach

                        </ul>
                    </li>
                @else
                    <li class="l1 ">
                        <a href="@if($item['link']){{ $item['link'] }}@else#@endif" title="{{ $item['title'] }}" class="l1">{{ $item['title'] }}</a>
                    </li>
                @endif

            @endforeach
        </ul>
    </div>
</div><!-- #offcanvas -->
<script src="{{ asset('/frontend/js/slider.min.js') }}"></script>
<script src="{{ asset('/frontend/js/slideshow.min.js') }}"></script>
<script src="{{ asset('/frontend/js/sticky.min.js') }}"></script>
<script src="{{ asset('/frontend/js/lightbox.min.js') }}"></script>
<script src="{{ asset('/frontend/js/jquery.flexslider-min.js') }}"></script>
<script src="{{ asset('/frontend/js/function2.js') }}"></script>
<script src="{{ asset('/frontend/js/library.js') }}"></script>
<script src="{{ asset('/frontend/js/jquery.fancybox.min.js') }}"></script>

<script src="{{ asset('/frontend/js/function.js') }}" type="text/javascript"></script>

<div id="modal-cart" class="uk-modal">
    <div class="uk-modal-dialog" style="width:768px;">
        <a class="uk-modal-close uk-close"></a>
        <div class="cart-content">


        </div>
    </div>
</div>

<div id="modal-alert" class="uk-modal">
    <div class="uk-modal-dialog uk-modal-dialog-small">
        <a class="uk-modal-close uk-close"></a>
        <div class="alert-content"></div>
    </div>
</div>

@yield('scripts')

</body>
</html>
