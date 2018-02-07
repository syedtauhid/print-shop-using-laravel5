<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>@yield('title')| Admin | DGD PRINT</title>
    @include('admin.template._partials.style')
</head>
<body>
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper">
    <!-- Navigation -->
    @include('admin.template._partials.navbar')
    <!-- Left navbar-header -->
    @include('admin.template._partials.left-navbar')
    <!-- Left navbar-header end -->
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            @yield('content')
        </div>
        <!-- /.container-fluid -->
        <footer class="footer text-center"> 2017 &copy; DGD PRINT </footer>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
@include('admin.template._partials.script')
</body>
</html>
