<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="#" rel="shortcut icon" type="image/x-icon">
    <meta http-equiv="content-language" content="vi">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Page not found (404)</title>
    <style type="text/css">
        body { background-color: #fff; color: #666; text-align: center; font-family: arial, sans-serif; }
        div.dialog {
            width: 50em;
            padding: 10px 4em;
            margin: 4em auto 0 auto;
            border: 1px solid #ccc;
            border-right-color: #999;
            border-bottom-color: #999;
        }
        h1, h2 { font-size: 100%; color: #f00; line-height: 1.5em; }
    </style>
</head>

<body>
<div class="dialog">
    <h1>Không tìm thấy đường dẫn này. </br> Bạn có thể bấm vào đây truy cập lại vào <a href="{{ route('frontend.homepage') }}" rel="home">trang chủ</a> của chúng tôi.</h1>
    <h2>Liên hệ: </h2>
    <a href="tel:0919 379 799">0919 379 799</a>  </br>
    <a href="mailto:dreamgovn@gmail.com">dreamgovn@gmail.com</a><br><br>
</div>
</body>
</html>
