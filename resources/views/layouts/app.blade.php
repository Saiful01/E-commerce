<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.includes.head')
</head>
<body><!-- Begin page -->
<div id="wrapper"><!-- Top Bar Start -->
    @include('admin.includes.topbar')
    @include('admin.includes.navbar')


    <div class="content-page"><!-- Start content -->
        <div class="content">
            <div class="container-fluid">


                @yield('content')


            </div><!-- container-fluid -->
        </div><!-- content -->
        <footer class="footer">
            © 2020 PixonLab - <span class="d-none d-sm-inline-block">Crafted with <i
                        class="mdi mdi-heart text-danger"></i> by PixonLab</span>.
        </footer>
    </div>

</div><!-- END wrapper --><!-- jQuery  -->
@include('admin.includes.footer')
</body>
</html>