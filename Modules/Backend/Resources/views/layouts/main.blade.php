<!DOCTYPE html>
<html>
<!-- head -->
@include('backend::layouts.head')
<body class="skin-blue pace-done">
<div class="wrapper row-offcanvas row-offcanvas-left">

    <!-- main-header -->
    @include('backend::layouts.main-header')

    <!-- main-sidebar -->
    @include('backend::layouts.main-sidebad')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('page_title')
            </h1>
            @yield('breadcrumb')
        </section>

        <!-- Main content -->
        <section class="content">
        @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- footer -->
    @include('backend::layouts.footer')


</div>

@stack('scripts')

</body>
</html>
