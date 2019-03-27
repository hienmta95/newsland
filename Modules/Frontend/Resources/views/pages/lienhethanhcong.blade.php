@extends('frontend::master')

@section('page_title', 'Liên hệ thành công')

@section('styles')

@endsection

@section('sliders')
    @include('frontend::pages.minislide')
@endsection

@section('content')

    <div class="breadcrumb">
        <ul class="uk-breadcrumb">
            <li><a href="{{ route('homepage') }}" title=""><i class="fa fa-home"></i> Trang chủ</a></li>
            <li><a href="{{ route('get.thanhcong') }}" title="">Liên hệ thành công </a></li>
        </ul>
    </div><!-- .breadcrumb -->

    <section class="contact-section">
        <section class="panel-body">
            <div class="uk-grid uk-grid-medium">
                <div class="uk-width-large-2-3 uk-width-xlarge-3-4">
                    <div class="contact-infomation">

                        <h2 class="company">Thư của bạn đã được gửi đi thành công, chúng tôi sẽ liên hệ lại với bạn trong thời gian sớm nhất.</h2>

                    </div><!-- .contact-infomation -->
                </div>

                @include('frontend::pages.sidebar')

            </div>
        </section>
    </section>

@endsection

@section('scripts')
    <script>
        (function ( $ ) {

        })(jQuery);
    </script>
@endsection
