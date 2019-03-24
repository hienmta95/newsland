@extends('frontend::master')

@section('page_title', 'Liên hệ')

@section('body_class', 'lienhe')

@section('styles')

@endsection

@section('sliders')
    @include('frontend::pages.minislide')
@endsection

@section('content')

    <div class="breadcrumb">
        <ul class="uk-breadcrumb">
            <li><a href="" title=""><i class="fa fa-home"></i> Trang chủ</a></li>
            <li><a href="" title="">Liên hệ</a></li>
        </ul>
    </div><!-- .breadcrumb -->

    <section class="contact-section">
        <section class="panel-body">
            <div class="uk-grid uk-grid-medium">
                <div class="uk-width-large-2-3 uk-width-xlarge-3-4">
                    <div class="contact-infomation">
                        <div class="note">Cám ơn quý khách đã ghé thăm website chúng tôi.</div>
                        <h2 class="company">{{ $info['tencongty'] }}</h2>
                        <div class="address">
                            <p><b>Địa chỉ:</b> {{ $info['diachicongty'] }}</p>
                            <p><b>Điện thoại:</b> {{ $info['sdtcongty'] }}</p>
                            <p><b>Email:</b> {{ $info['emailcongty'] }}</p>
                            <p><b>Website:</b> {{ route('homepage') }}</p>
                        </div>
                        <div class="contact-map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d7650.195634162331!2d105.76105447783796!3d20.975320212964228!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1zMTYgLSBMaeG7gW4ga-G7gSAxMywgS8SQVCBWxINuIEtow6osIFAuTGEgS2jDqiA!5e0!3m2!1svi!2s!4v1553440670051" width="870" height="330" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div><!-- .contact-infomation -->
                </div>

                <div class="uk-width-large-1-3 uk-width-xlarge-1-4">
                    <div class="contact-form">
                        <div class="label">Mời bạn điền vào mẫu thư liên lạc và gửi đi cho chúng tôi. Các chuyên viên tư vấn của chúng tôi sẽ trả lời bạn trong thời gian sớm nhất.</div>
                        <form action="{{ route('post.lienhe') }}" method="post" class="uk-form form">
                            @csrf
                            <div class="uk-grid lib-grid-20 uk-grid-width-small-1-2 uk-grid-width-large-1-1">
                                <div class="form-row">
                                    <input type="text" name="hoten" class="uk-width-1-1 input-text" placeholder="Họ &amp; tên *" />
                                </div>
                                <div class="form-row">
                                    <input type="email" name="email" class="uk-width-1-1 input-text" placeholder="Email *" />
                                </div>
                                <div class="form-row">
                                    <input type="number" name="sdt" class="uk-width-1-1 input-text" placeholder="Phone *" />
                                </div>
                            </div><!-- .uk-grid -->
                            <div class="form-row">
                                <textarea name="noidung" class="uk-width-1-1 form-textarea" placeholder="Nội dung *"></textarea>
                            </div>
                            <div class="form-row uk-text-right">
                                <input type="submit" name="create" class="btn-submit" value="Gửi đi" />
                            </div>
                        </form>
                    </div>
                </div>
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
