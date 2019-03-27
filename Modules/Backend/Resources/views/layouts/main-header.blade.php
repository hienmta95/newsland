<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('backend.dashboard') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="{{asset("/images/icon_logo.png")}}"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"> - NewsLand Admin - </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php $user = Auth::guard('web')->user(); ?>
                        <span><i class="glyphicon glyphicon-user"></i> {!! $user ? $user->username : "" !!}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{asset('/images/spicemart-icon.png')}}" class="img-circle" alt="User Image">
                            <p>
                                {!!  $user ? $user->username : "" !!} - Admin
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer" style="background-color: #48677d">
                            {{--<div class="pull-left">--}}
                            {{--<a href="#" class="btn btn-default btn-flat">Profile</a>--}}
                            {{--</div>--}}
                            <div class="col-xs-12 text-center">
                                <a href="{{ route('backend.logout') }}" class="btn btn-default btn-flat" style="background-color: #ffffff; font-weight: 700;">Đăng xuất</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
