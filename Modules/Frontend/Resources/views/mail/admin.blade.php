@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Liên hệ NewslandVN
        @endcomponent
    @endslot

    Khách hàng có tên {{ $data['hoten'] }} vừa mới thực hiện một liên hệ từ phía website {{ route('homepage') }}
    <br />
    Thông tin của khách hàng:<br />
    Họ tên : {{ $data['hoten'] }}<br />
    SĐT: {{ $data['sdt'] }}<br />
    Email: {{ $data['email'] }}<br />
    Nội dung: {{ $data['noidung'] }}<br />

    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} NewslandVN. superAdmin!
        @endcomponent
    @endslot
@endcomponent
