<section class="main-slide">

    <div class="uk-slidenav-position" data-uk-slideshow="{animation: 'swipe', autoplay: true, autoplayInterval: 7500}">
        <ul class="uk-slideshow">

            @foreach($minislide as $item)
                <li class="item">
                    <a class="image img-cover" href="#" title="{{ asset('/'). $item['image']['url'] }}"><img src="{{ asset('/'). $item['image']['url'] }}" alt="{{ asset('/'). $item['image']['url'] }}" /></a>
                </li>
            @endforeach
        </ul>
        <ul class="uk-dotnav uk-dotnav-contrast uk-position-bottom uk-flex-center">
            @foreach($minislide as $key=>$item)
                <li data-uk-slideshow-item="{{ $key }}"><a href=""></a></li>
            @endforeach
        </ul>
    </div>

</section><!-- .main-slide -->
