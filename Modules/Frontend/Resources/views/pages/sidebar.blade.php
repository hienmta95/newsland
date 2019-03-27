<div class="uk-width-large-1-4 uk-visible-large">
    <aside class="aside">
        <div class="aside-support">
            <div class="hotline">
                <a href="tel: 0977823228" title="Hotline">
                    <span class="label">Hotline</span>
                    <span class="value">{{ $info['sdtcongty'] }}</span>
                </a>
            </div>
            <div class="text">
                <p>Để có căn hot, giá tốt</p>
                <p>Giá chính xác từ chủ đầu tư cho từng căn</p>
                <p>Được tư vấn lựa chọn các gói vay có lãi suất <b style="color: #ff0000;">thấp nhất</b>, thời gian vay dài nhất</p>
            </div>
        </div><!-- .aside-support -->

        @foreach($theloaiSidebar as $category)
        @if(count($category['bietthu']) > 0 )

        <section class="aside-panel aside-project">
            <header class="panel-head">
                <h3 class="heading"><span>{{ $category['title'] }}</span></h3>
            </header>
            <section class="panel-body">
                <ul class="uk-list list">

                    @foreach($category['bietthu'] as $item)
                        <li>
                            <a href="{{ route('bietthu', ['id'=>$item['id'], 'slug'=>$item['slug']]) }}" title="{{ $item['title'] }}">{{ $item['title'] }}</a></li>
                    @endforeach

                </ul>
            </section>
        </section><!-- .aside-panel -->

        @endif
        @endforeach

        <section class="aside-panel aside-news">
            <header class="panel-head">
                <h3 class="heading"><span>Tin tức</span></h3>
            </header>
            <section class="panel-body">
                <ul class="uk-list list">

                    @foreach($tintucSidebar as $item)
                    <li>
                        <article class="uk-clearfix article">
                            <div class="thumb">
                                <a class="image img-cover" href="{{ route('tintuc', ['id'=>$item['id'], 'slug'=>$item['slug']]) }}" title="{{ $item['title'] }}"><img src="{{ cxl_asset('/'). $item['image']['url'] }}" alt="{{ $item['title'] }}" /></a>
                            </div>
                            <div class="infor">
                                <h4 class="title"><a href="{{ route('tintuc', ['id'=>$item['id'], 'slug'=>$item['slug']]) }}" title="{{ $item['title'] }}">{{ $item['title'] }}</a></h4>
                            </div>
                        </article>
                    </li>
                    @endforeach

                </ul>
            </section>
        </section><!-- .aside-panel -->

        <section class="aside-video">
            <header class="panel-head">
                <h3 class="heading"><span>Video</span></h3>
            </header>
            <section class="panel-body">
                <div class="video">
                    <iframe width="100%" height="100%" src="{{ str_replace( 'watch?v=', 'embed/', $videoSidebar['video'] ) }}" frameborder="0" allowfullscreen></iframe>
                </div>
            </section>
        </section><!-- .aside-video -->

        {{--<section class="aside-facebook">--}}
            {{--<header class="panel-head">--}}
                {{--<h3 class="heading"><span>Facebook</span></h3>--}}
            {{--</header>--}}
            {{--<section class="panel-body">--}}
                {{--<div class="video">--}}
                    {{--<div class="fb-page" data-href="https://www.facebook.com/nhadatvietgiatot" data-tabs="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div>--}}
                {{--</div>--}}
            {{--</section>--}}
        {{--</section><!-- .aside-video -->--}}
    </aside><!-- aside -->
</div>
