@extends('frontend::master')

@section('page_title', "Video")

@section('sliders')
    @include('frontend::pages.minislide')
@endsection

@section('styles')

@endsection

@section('content')

    <div class="breadcrumb">
        <ul class="uk-breadcrumb">
            <li><a href="{{ route('homepage') }}" title=""><i class="fa fa-home"></i> Trang chủ</a></li>
            <li><a href="{{ route('videos') }}" title="Videos">Videos</a></li>
        </ul>
    </div><!-- .breadcrumb -->

    <div class="uk-grid uk-grid-collapse fix-grid-960">
        <div class="uk-width-large-3-4">
            <section class="prdcatalogue">
                <header class="panel-head">
                    <h1 class="heading"><span>Danh sách videos </span></h1>
                </header>
                <section class="panel-body">
                    <ul class="uk-grid lib-grid-20 uk-grid-width-1-2 uk-grid-width-medium-1-3 list-article" data-uk-grid-match="{target: '.article .title'}">

                        @foreach($items as $item)
                            <li>
                                <article class="uk-clearfix article">
                                    <div class="thumb">
                                        <a class="image img-cover" href="#" >
                                            <iframe class="embed1" width="100%" height="auto" src="{{ str_replace( 'watch?v=', 'embed/', $item['video'] ) }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </a>
                                    </div>
                                    <div class="infor">
                                        <h3 class="title">
                                            <a class="title1" href="#" title="{{ $item['title'] }}">
                                                {{ $item['title'] }}</a>
                                        </h3>
                                        <div class="description descrip1">{!! $item['tomtat'] !!}</div>
                                    </div>
                                </article><!-- .article -->
                            </li>
                        @endforeach

                    </ul>
                </section>
                <footer class="panel-foot">
                </footer>
                {{ $items->links() }}
            </section><!-- .prdcatalogue -->
        </div>

        @include('frontend::pages.sidebar')

    </div>

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

            $('body').on('click', '.prdcatalogue ul li', '.title1' , function (e) {
                e.preventDefault();
                var _self = $(this),
                    title = $(this).find('.title1').text(),
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
