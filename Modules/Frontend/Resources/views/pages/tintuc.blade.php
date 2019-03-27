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
        </ul>
    </div><!-- .breadcrumb -->


    <div class="uk-grid uk-grid-collapse fix-grid-960">
        <div class="uk-width-large-3-4">
            <section class="artcatalogue">
                <header class="panel-head">
                    <h1 class="heading"><span>{{ $trang['title'] }}</span></h1>
                </header>
                <section class="panel-body">
                    <ul class="uk-list list-articles">

                        @foreach($items as $item)
                        <li>
                            <article class="uk-clearfix article">
                                <div class="thumb">
                                    <a class="image img-cover" href="{{ route($trang['route2'], ['id' => $item['id'], 'slug' => $item['slug']]) }}" title="{{ $item['title'] }}"><img src="{{ cxl_asset('/'). $item['image']['url'] }}" alt="{{ $item['title'] }}" /></a>
                                </div>
                                <div class="infor">
                                    <div class="meta">{{ date_format(date_create($item['updated_at']),"d/m/Y") }}</div>
                                    <h3 class="title"><a href="{{ route($trang['route2'], ['id' => $item['id'], 'slug' => $item['slug']]) }}" title="{{ $item['title'] }}">{{ $item['title'] }}</a></h3>
                                    <div class="description">
                                    </div>
                                    <div class="viewmore"><a href="{{ route($trang['route2'], ['id' => $item['id'], 'slug' => $item['slug']]) }}" title="Xem thêm">Xem thêm <i class="fa fa-angle-double-right"></i></a></div>
                                </div>
                            </article><!-- .article -->
                        </li>
                        @endforeach

                    </ul>
                </section>

                {{ $items->links() }}

            </section><!-- .artcatalogue -->
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
