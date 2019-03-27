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
            <li><a href="{{ route($trang['route1']) }}" title="{{ $trang['title'] }}">{{ $trang['title'] }}</a></li>
            <li><a href="#" title="{{ $item['title'] }}">{{ $item['title'] }}</a></li>
        </ul>
    </div><!-- .breadcrumb -->


    <div class="uk-grid uk-grid-collapse fix-grid-960">
        <div class="uk-width-large-3-4">
            <section class="art-detail">
                <section class="panel-body">
                    <h1 class="main-title"><span>{{ $item['title'] }}</span></h1>
                    <article class="article">
                        <div class="description">
                            {!! $item['tomtat'] !!}
                        </div>
                        <div class="contents">
                            <h1 class="post-title" style="box-sizing: border-box; margin: 13px 0px; font-family: Roboto, serif; line-height: 1.3; color: rgb(3, 33, 57); font-size: 30px;">{{ $item['title'] }}</h1>
                            {!! $item['noidung'] !!}
                        </div>
                    </article>
                </section><!-- .panel-body -->

                <h1>Share fb here</h1>
                <footer class="panel-foot">
                    <div class="uk-flex uk-flex-middle share_box">
                        <div class="fb-send" data-href="http://nhagiatot.net/tnr-goldmark-city-to-chuc-cuoc-thi-checkin-hom-nay-nhan-ngay-iphone-xs-max-cung-tnr-tower.html"></div>
                        <div class="fb-like" data-href="http://nhagiatot.net/tnr-goldmark-city-to-chuc-cuoc-thi-checkin-hom-nay-nhan-ngay-iphone-xs-max-cung-tnr-tower.html" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
                        <div class="g-plusone plus" data-size="medium" data-href=""></div>
                        <div class="zalo-share-button" data-href="http://nhagiatot.net/tnr-goldmark-city-to-chuc-cuoc-thi-checkin-hom-nay-nhan-ngay-iphone-xs-max-cung-tnr-tower.html" data-oaid="579745863508352884" data-layout="2" data-color="blue" data-customize="false"></div>
                    </div>
                </footer>

            </section><!-- .art-detail -->

            <section class="artsame">
                <header class="panel-head">
                    <h2 class="heading"><span>Tin cùng danh mục</span></h2>
                </header>
                <section class="panel-body">
                    <ul class="uk-grid lib-grid-15 uk-grid-width-1-2 uk-grid-width-medium-1-3 list-article" data-uk-grid-match="{target: '.article .title'}">

                        @foreach($same as $item)
                        <li>
                            <article class="uk-clearfix article">
                                <div class="thumb">
                                    <a class="image img-cover" href="{{ route($trang['route2'], ['id'=>$item['id'], 'slug'=>$item['slug']]) }}" title="{{ $item['title'] }}"><img src="{{ cxl_asset('/'). $item['image']['url'] }}" alt="{{ $item['title'] }}" /></a>
                                </div>
                                <h3 class="title"><a href="{{ route($trang['route2'], ['id'=>$item['id'], 'slug'=>$item['slug']]) }}" title="{{ $item['title'] }}">{{ $item['title'] }}</a></h3>
                            </article><!-- .article -->
                        </li>
                        @endforeach

                    </ul>
                </section>
            </section><!-- .artsame -->
        </div>

        @include('frontend::pages.sidebar')

    </div>

@endsection

@section('scripts')
    <script>
        (function ( $ ) {

        })(jQuery);
    </script>
@endsection
