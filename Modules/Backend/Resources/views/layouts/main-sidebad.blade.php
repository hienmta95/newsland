<?php

if (! function_exists('active_route')) {
    /**
     * Return the "active" class if current route is matched.
     *
     * @param  string|array $route
     * @param  string $output
     * @return string|null
     */
    function active_route($route)
    {
        $output = 'active';
        if ($route == 1) {
            $route = [
                'backend.slide.index','backend.slide.show',
                'backend.slide.create','backend.slide.edit',

                'backend.minislide.index','backend.minislide.show',
                'backend.minislide.create','backend.minislide.edit',

                'backend.tintuc.index','backend.tintuc.show',
                'backend.tintuc.create','backend.tintuc.edit',

                'backend.video.index','backend.video.show',
                'backend.video.create','backend.video.edit',

                'backend.gioithieu.index','backend.gioithieu.show',
                'backend.gioithieu.create','backend.gioithieu.edit',

                'backend.noithat.index','backend.noithat.show',
                'backend.noithat.create','backend.noithat.edit',
            ];
        }


        if ($route == 2) {
            $route = [
                'backend.thanhpho.index','backend.thanhpho.show',
                'backend.thanhpho.create','backend.thanhpho.edit',

                'backend.quan.index','backend.quan.show',
                'backend.quan.create','backend.quan.edit',

                'backend.theloai.index','backend.theloai.show',
                'backend.theloai.create','backend.theloai.edit',

            ];
        }

        if ($route == 3) {
            $route = [

                'backend.bietthu.index','backend.bietthu.show',
                'backend.bietthu.create','backend.bietthu.edit',

                'backend.mucnoidung.index','backend.mucnoidung.show',
                'backend.mucnoidung.create','backend.mucnoidung.edit',

                'backend.dashboard'
            ];
        }

        if ($route == 4) {
            $route = [
                'backend.user.index','backend.user.show',
                'backend.user.create','backend.user.edit',

                'backend.menu.index','backend.menu.show',
                'backend.menu.create','backend.menu.edit',

                'backend.lienhe.index','backend.lienhe.show',
                'backend.lienhe.create','backend.lienhe.edit',

                'backend.thongtin.edit'
            ];
        }

        if (is_array($route)) {
            if (call_user_func_array('Route::is', $route)) {
                return $output;
            }
        } else {
            if (\Route::is($route)) {
                return $output;
            }
        }
        return '';
    }
}

?>


<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset("/images/spicemart-icon.png")}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Hello, {{ Auth::guard('web')->user()->username }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

        <!-- User management data -->
        <li class="treeview {{ active_route(1) }}">
            <a href="#">
                <i class="glyphicon glyphicon-cog"></i>
                <span>Quản lý slide & tin tức</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ active_route('backend.slide.*') }}"><a href="{{ route('backend.slide.index') }}">» Slide trang chủ</a></li>
                <li class="{{ active_route('backend.minislide.*') }}"><a href="{{ route('backend.minislide.index') }}">» Mini slide</a></li>
                <li class="{{ active_route('backend.tintuc.*') }}"><a href="{{ route('backend.tintuc.index') }}">» Tin tức </a></li>
                <li class="{{ active_route('backend.video.*') }}"><a href="{{ route('backend.video.index') }}">» Videos </a></li>
                <li class="{{ active_route('backend.noithat.*') }}"><a href="{{ route('backend.noithat.index') }}">» Bài viết về nội thất </a></li>
                <li class="{{ active_route('backend.gioithieu.*') }}"><a href="{{ route('backend.gioithieu.index') }}">» Bài viết giới thiệu </a></li>
            </ul>
        </li>
        <!-- End User management data -->

        <!-- User management data -->
        <li class="treeview {{ active_route(2) }}">
            <a href="#">
                <i class="glyphicon glyphicon-calendar"></i>
                <span>Quản lý danh mục </span>
                <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ active_route('backend.thanhpho.*') }}"><a href="{{ route('backend.thanhpho.index') }}">» Tỉnh / Thành phố</a></li>
                <li class="{{ active_route('backend.quan.*') }}"><a href="{{ route('backend.quan.index') }}">» Quận / Huyện</a></li>
                <li class="{{ active_route('backend.theloai.*') }}"><a href="{{ route('backend.theloai.index') }}">» Thể loại nhà đất</a></li>

            </ul>
        </li>
        <!-- End User management data -->

        <!-- User management data -->
        <li class="treeview {{ active_route(3) }}">
            <a href="#">
                <i class="glyphicon glyphicon-list"></i>
                <span>Quản lý bất động sản </span>
                <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
    </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ active_route('backend.bietthu.*') }}{{ active_route('backend.dashboard') }}"><a href="{{ route('backend.bietthu.index') }}">» Bất động sản</a></li>
                <li class="{{ active_route('backend.mucnoidung.*') }}"><a href="{{ route('backend.mucnoidung.index') }}">» Các mục nội dung của BĐS</a></li>

            </ul>
        </li>
        <!-- End User management data -->

        <!-- User management data -->
        <li class="treeview {{ active_route(4) }}">
            <a href="#">
                <i class="glyphicon glyphicon-home"></i>
                <span>Quản lý chung </span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ active_route('backend.user.*') }}"><a href="{{ route('backend.user.index') }}">» Danh sách admin</a></li>
                <li class="{{ active_route('backend.menu.*') }}"><a href="{{ route('backend.menu.index') }}">» Quản lý menu</a></li>
                <li class="{{ active_route('backend.lienhe.*') }}"><a href="{{ route('backend.lienhe.index') }}">» Danh sách liên hệ </a></li>
                <li class=""><a href="{{ route('backend.thongtin.edit') }}">» Thông tin chung </a></li>
            </ul>
        </li>
        <!-- End User management data -->

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
