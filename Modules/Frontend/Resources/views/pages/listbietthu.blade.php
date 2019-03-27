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
            <li><a href="#" title="{{ $trang['title'] }}">{{ $trang['title'] }}</a></li>
        </ul>
    </div><!-- .breadcrumb -->

    <div class="uk-grid uk-grid-collapse fix-grid-960">
        <div class="uk-width-large-3-4">
            <section class="prdcatalogue">
                <header class="panel-head">
                    <h1 class="heading"><span>{{ $trang['title'] }}</span></h1>
                </header>
                <section class="panel-body">
                    <ul class="uk-grid lib-grid-20 uk-grid-width-1-2 uk-grid-width-medium-1-3 list-article" data-uk-grid-match="{target: '.article .title'}">

                        @foreach($items as $item)
                        <li>
                            <article class="uk-clearfix article">
                                <div class="thumb"><a class="image img-cover" href="{{ route('bietthu', ['id'=>$item['id'], 'slug'=>$item['slug']]) }}" title="{{ $item['title'] }}"><img src="{{ asset('/'). $item['image']['url'] }}" alt="{{ $item['title'] }}" /></a></div>
                                <div class="infor">
                                    <h3 class="title"><a href="{{ route('bietthu', ['id'=>$item['id'], 'slug'=>$item['slug']]) }}" title="{{ $item['title'] }}">{{ $item['title'] }}</a></h3>
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
                <footer class="panel-foot">
                </footer>

                {{ $items->links() }}
            </section><!-- .prdcatalogue -->
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
