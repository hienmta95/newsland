@extends('frontend::master')

@section('page_title', 'NewsLand VN')

@section('body_class', 'home')

@section('stick')
    data-uk-sticky=""
@endsection

@section('sliders')
    <section class="main-slide">
        <div class="uk-slidenav-position" data-uk-slideshow="{animation: 'swipe', autoplay: true, autoplayInterval: 7500}">
            <ul class="uk-slideshow">
                @foreach($slide as $item)
                    <li class="item">
                        <a class="image img-cover" href="{{ $item['link'] }}" title="{{ $item['title'] }}"><img src="{{ asset('/'). $item['image']['url'] }}" alt="{{ asset('/'). $item['image']['url'] }}" /></a>
                    </li>
                @endforeach
            </ul>
            <ul class="uk-dotnav uk-dotnav-contrast uk-position-bottom uk-flex-center">
                @foreach($slide as $key=>$item)
                    <li data-uk-slideshow-item="{{ $key }}"><a href=""></a></li>
                @endforeach
            </ul>
        </div>
    </section><!-- .main-slide -->
@endsection

@section('styles')

@endsection

@section('content')

    @foreach($theloai as $category)
        @if($category['id'] == 4)
            <section class="homepage-category">
                <header class="panel-head">
                    <h2 class="heading">
                        <a href="{{ route('theloai', ['id' => $category['id'], 'slug' => $category['slug']]) }}" title="{{ $category['title'] }}">{{ $category['title'] }}</a>
                    </h2>
                </header>
                <section class="panel-body">
                    <ul class="uk-grid lib-grid-20 uk-grid-width-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 list-article" data-uk-grid-match="{target: '.article .title'}">

                        @foreach($daSuDung as $item)
                            <li>
                                <article class="uk-clearfix article">
                                    <div class="thumb img-zoomin">
                                        <a class="image img-cover" href="{{ route('bietthu', ['id' => $item['id'], 'slug' => $item['slug']]) }}" title="{{ $item['title'] }}">
                                            <img src="{{ asset('/'). $item['image']['url'] }}" alt="{{ $item['title'] }}" />
                                        </a>
                                    </div>
                                    <div class="infor">
                                        <h3 class="title"><a href="{{ route('bietthu', ['id' => $item['id'], 'slug' => $item['slug']]) }}" title="{{ $item['title'] }}">{{ $item['title'] }}</a></h3>
                                        <div class="price">
                                            <span class="label">Giá: </span>
                                            <span class="value">
                                    @if(!empty($item['gia'])) {{ $item['gia'] }} @else Liên hệ @endif
                                </span>
                                        </div>
                                        <div class="description">{!! $item['mota'] !!}</div>
                                    </div>
                                </article><!-- .article -->
                            </li>
                        @endforeach

                    </ul>
                </section>
            </section>
        @else
            @if(count($category['bietthu']) > 0 )
                <section class="homepage-category">
                    <header class="panel-head">
                        <h2 class="heading">
                            <a href="{{ route('theloai', ['id' => $category['id'], 'slug' => $category['slug']]) }}" title="{{ $category['title'] }}">{{ $category['title'] }}</a>
                        </h2>
                    </header>
                    <section class="panel-body">
                        <ul class="uk-grid lib-grid-20 uk-grid-width-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 list-article" data-uk-grid-match="{target: '.article .title'}">

                            @foreach($category['bietthu'] as $item)
                                <li>
                                    <article class="uk-clearfix article">
                                        <div class="thumb img-zoomin">
                                            <a class="image img-cover" href="{{ route('bietthu', ['id' => $item['id'], 'slug' => $item['slug']]) }}" title="{{ $item['title'] }}">
                                                <img src="{{ asset('/'). $item['image']['url'] }}" alt="{{ $item['title'] }}" />
                                            </a>
                                        </div>
                                        <div class="infor">
                                            <h3 class="title"><a href="{{ route('bietthu', ['id' => $item['id'], 'slug' => $item['slug']]) }}" title="{{ $item['title'] }}">{{ $item['title'] }}</a></h3>
                                            <div class="price">
                                                <span class="label">Giá: </span>
                                                <span class="value">
                                    @if(!empty($item['gia'])) {{ $item['gia'] }} @else Liên hệ @endif
                                </span>
                                            </div>
                                            <div class="description">{!! $item['mota'] !!}</div>
                                        </div>
                                    </article><!-- .article -->
                                </li>
                            @endforeach

                        </ul>
                    </section>
                </section>
            @endif
        @endif

    @endforeach

    <div class="uk-grid lib-grid-20">
        <div class="uk-width-xlarge-3-4">

            <section class="homepage-news">
                <header class="panel-head">
                    <h2 class="heading"><a href="{{ route('tintuc.list') }}" title="Tin tức">Tin tức</a></h2>
                </header>
                <section class="panel-body">
                    <div class="uk-grid lib-grid-15">
                        <div class="uk-width-medium-1-2">

                            {{--first tin tuc--}}
                            <article class="uk-clearfix featured">
                                <div class="thumb img-zoomin"><a class="image img-cover" href="{{ route('tintuc', ['id' => $tintuc[0]['id'], 'slug' => $tintuc[0]['slug']]) }}" title="{{ $tintuc[0]['title'] }}"><img src="{{ asset('/'). $tintuc[0]['image']['url'] }}" alt="{{ $tintuc[0]['title'] }}" /></a></div>
                                <div class="infor">
                                    <h3 class="title"><a href="{{ route('tintuc', ['id' => $tintuc[0]['id'], 'slug' => $tintuc[0]['slug']]) }}" title="{{ $tintuc[0]['title'] }}">{{ $tintuc[0]['title'] }}</a></h3>
                                </div>
                            </article>

                        </div>
                        <div class="uk-width-medium-1-2">
                            <ul class="uk-list list-article">

                                @foreach($tintuc as $key=>$item)
                                @if($key != 0)
                                <li>
                                    <article class="uk-clearfix article">
                                        <div class="thumb img-zoomin"><a class="image img-cover" href="{{ route('tintuc', ['id' => $item['id'], 'slug' => $item['slug']]) }}" title="{{ $item['title'] }}"><img src="{{ asset('/'). $item['image']['url'] }}" alt="{{ $item['title'] }}" /></a></div>
                                        <div class="infor">
                                            <h3 class="title"><a href="{{ route('tintuc', ['id' => $item['id'], 'slug' => $item['slug']]) }}" title="{{ $item['title'] }}">{{ $item['title'] }}</a></h3>
                                            <div class="description">
                                                {!! $item['tomtat'] !!}
                                            </div>
                                        </div>
                                    </article><!-- .article -->
                                </li>

                                @endif
                                @endforeach

                            </ul>
                        </div>
                    </div><!-- .uk-grid -->
                </section>
            </section><!-- .homepage-category -->
        </div>

        <div class="uk-width-xlarge-1-4">
            <section class="homepage-post">
                <header class="panel-head">
                    <h2 class="heading"><a href="{{ route('noithat.list') }}" title="Nội thất">Nội thất</a></h2>
                </header>
                <section class="panel-body">
                    <div class="uk-slidenav-position slider" data-uk-slider="{autoplay: true, autoplayInterval: 5500}">
                        <div class="uk-slider-container">
                            <ul class="uk-slider uk-grid uk-grid-collapse uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 uk-grid-width-xlarge-1-1 list-article">

                                @foreach($noithat as $item)
                                <li>
                                    <article class="uk-clearfix article">
                                        <div class="thumb img-zoomin"><a class="image img-cover" href="{{ route('noithat', ['id' => $item['id'], 'slug' => $item['slug']]) }}" title="{{ $item['title'] }}"><img src="{{ asset('/'). $item['image']['url'] }}" alt="{{ $item['title'] }}" /></a></div>
                                        <div class="infor">
                                            <h3 class="title"><a href="{{ route('noithat', ['id' => $item['id'], 'slug' => $item['slug']]) }}" title="{{ $item['title'] }}">{{ $item['title'] }}</a></h3>
                                            <div class="description">
                                                {!! $item['tomtat'] !!}											                                            </div>
                                        </div>
                                    </article><!-- .article -->
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </div><!-- .slider -->
                </section>
            </section>
        </div>
    </div><!-- .uk-grid -->

    <section class="partner-section" style="margin-top: 30px">
        <div class="uk-container uk-container-center">
            <header class="panel-head consultant-section">
                <h2 class="heading uk-text-center"><span>Videos</span></h2>
            </header>
            <section class="panel-body">
                <div class="uk-slidenav-position slider" data-uk-slider="{autoplay: true, autoplayInterval: 10500}">
                    <div class="uk-slider-container">
                        <ul id="video-slide" class="uk-slider uk-grid uk-grid-small uk-grid-width-1-1 uk-grid-width-small-1-1 uk-grid-width-medium-1-4 uk-grid-width-large-1-4 uk-grid-width-xlarge-1-4">

                            @foreach($video as $item)
                            <li data-slider-slide="4" class="uk-slide-before">
                                <div class="thumb">
                                    <iframe class="embed1" width="100%" height="auto" src="{{ str_replace( 'watch?v=', 'embed/', $item['video'] ) }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    <p class="title1">
                                        <span style="font-weight: 400">{{ $item['title'] }}</span>
                                        <span style="color: #00a157"> - view more</span>
                                    <div class="descrip1" style="display: none">
                                        {!! $item['tomtat'] !!}
                                    </div>
                                </div>
                            </li>
                            @endforeach

                        </ul>
                        <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slider-item="previous" draggable="false"></a>
                        <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slider-item="next" draggable="false"></a>
                    </div>
                </div><!-- .slider -->
            </section>
        </div>
    </section>

    <div id="order-confirm-popup" style="display: none">
        <section class="entry-content">
            <h3 class="title-table" id="title2">

            </h3>
            <br>
            <div class="thumbnail">
                <iframe id="embed2" width="100%" height="500" src="https://www.youtube.com/embed/UMOyunC3HGw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <br>
            <div class="custom-order" style="width: auto">
                <div class="description">
                    <h3 class="title-list-feat">
                        <div id="descrip2" style="font-weight: 400"></div>
                    </h3>
                </div>
            </div>

        </section>
    </div>

@endsection

@section('scripts')
    <script>
        (function ( $ ) {

            $('body').on('click', '#video-slide li', function (e) {
                e.preventDefault();
                var _self = $(this),
                    title = $(this).find('.title1 span').text(),
                    embed = $(this).find('.embed1').attr('src'),
                    descrip = $(this).find('.descrip1').html();

                console.log(descrip);
                $.fancybox.open({
                    src: '#order-confirm-popup',
                    opts: {
                        beforeShow: function() {
                            $('#title2').text(title);
                            $('#embed2').attr('src', embed);
                            $('#descrip2').html(descrip);
                        }
                    }
                });
            });

        })(jQuery);
    </script>
@endsection
