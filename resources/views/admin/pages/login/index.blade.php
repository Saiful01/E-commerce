<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>Login</title>
    <meta content="Admin Dashboard" name="description">
    <meta content="Themesbrand" name="author">
    <link rel="shortcut icon" href="/admin/assets/images/favicon.ico">
    <link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/admin/assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
    <link href="/admin/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="/admin/assets/css/style.css" rel="stylesheet" type="text/css">
</head>
<body><!-- Begin page -->
<div class="wrapper-page">
    <div class="card">
        <div class="card-body">
            <h3 class="text-center m-0">

            </h3>
            <div class="p-3"><h4 class="text-muted font-18 m-b-5 text-center">Welcome Back !</h4>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{session('success')}}!</strong>
                    </div>
                @endif
                @if(session('failed'))
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{session('failed')}}!</strong>
                    </div>
                @endif

                <form class="form-horizontal m-t-30" action="/admin/login-check" method="post">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter Email">
                        <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}" placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password">
                    </div>
                    <div class="form-group row m-t-20">
                        <div class="col-6">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customControlInline">
                                <label class="custom-control-label" for="customControlInline">Remember me</label>
                            </div>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>
                    <div class="form-group m-t-10 mb-0 row">
                        <div class="col-12 m-t-20">
                            <a href="#" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="m-t-40 text-center">
        <p>© 2018 PixonLab. Crafted with <i class="mdi mdi-heart text-danger"></i> by PixonLab</p></div>
</div><!-- jQuery  -->
<script src="/admin/assets/js/jquery.min.js"></script>
<script src="/admin/assets/js/bootstrap.bundle.min.js"></script>
<script src="/admin/assets/js/metisMenu.min.js"></script>
<script src="/admin/assets/js/jquery.slimscroll.js"></script>
<script src="/admin/assets/js/waves.min.js"></script>
<script src="/admin/plugins/jquery-sparkline/jquery.sparkline.min.js"></script><!-- App js -->
<script src="/admin/assets/js/app.js"></script>
</body>
</html>
