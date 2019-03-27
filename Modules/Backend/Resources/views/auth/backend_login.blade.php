
<!DOCTYPE html>
<html lang="{{app() ->getLocale()}}" class="bg-black" style="min-height: 527px">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    <link href="{{asset('/backend/dist/css/AdminLTE.css')}}" rel="stylesheet">
    <link href="{{asset('/backend/bower_components/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <script src="{{asset('/js/app.js')}}"></script>
</head>
<body class="bg-black">
        <div class="login-box" >

            <div class="header">Sign In</div>
                <form id="login-form" method="POST" action="{{ route('backend.login.submit') }}">
                @csrf
                    <div class="body bg-gray">
                        <p>Please fill out the following fields to login:</p>
                        <div class="form-group">
                            <label class="control-label" >Username</label>
                            <input id="username" type="text" class="form-control-login{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}">
                            @if ($errors->has('username'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group @if ($errors->any()) has-error @endif ">
                            <label class="control-label" for="password">Password</label>
                            <input id="password" type="password" class="form-control-login{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            @if($errors ->any())
                                <div class="help-block">{!! $errors->first('error') !!}</div>
                            @endif
                        </div>
                        {{--<div class="form-group">--}}
                            {{--<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>--}}
                            {{--<label>Remember Me</label>--}}

                        {{--</div>--}}
                    </div>
                <div class="footer">

                    <button type="submit" class="btn bg-olive btn-block" name="login-button">Login</button>
                </div>
                </form>
        </div>



</body>
</html>
