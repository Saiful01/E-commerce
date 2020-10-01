<!--
Crafted by:
......................
Name: Motiur Rahaman
Email: memotiur@gmail.com
Website: www.pixonlab.com
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <link rel="icon" href="/ecommerce/img/favicon.png"/>
    <meta charset="utf-8">
    <meta name="description"
          content="যশোরের ঐতিহ্যবাহী খেজুরের গুড়-পাটালি’র অনলাইন বিপণন বাজার ‘কেনারহাট’। গাছিদের নিবিড় তত্ত্বাবধানে নির্ভেজাল গুড়-পাটালি উৎপাদন ও বাজার ব্যবস্থাপনাই কেনারহাটের লক্ষ্য। ">
    <meta name="keywords" content="kenarhat,kenarhut, kenarhaat, কেনারহাট ,kenarhat.com,কেনারহাট.কম">
    <meta name="author" content="Motiur Rahaman">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

    <link rel="stylesheet" href="/ecommerce/css/custom.css">

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="/js/custom_angular.js"></script>

    <!--Toaster-->
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    {{--    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>--}}
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

</head>
<body ng-app="myApp" ng-controller="myCtrl">

<nav class="navbar navbar-expand-md navbar-dark bg-dark  fixed-top">

    <div class="container">
        <a class="navbar-brand" href="/"><img src="/ecommerce/img/logo.png" height="40px" class="img-thumbnail logo-img"> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarsExampleDefault">
            <ul class="navbar-nav m-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/"><i class="fa fa-home"></i>হোম </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        <i class="fa fa-tags"></i>ক্যাটেগরি
                    </a>
                    <div class="dropdown-menu">
                        @foreach($categories as $category)
                            <a class="dropdown-item"
                               href="/product/category/{{$category->category_id}}">{{$category->category_name}}</a>
                        @endforeach
                        <a class="dropdown-item"
                           href="/categories">সকল ক্যাটেগরি</a>

                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/customer/checkout"><i class="fa fa-shopping-cart"></i>কার্ট </a>
                </li>

            </ul>

            <form class="form-inline my-2 my-lg-0 ng-pristine ng-valid">
                {{--<div class="input-group input-group-sm">
                    <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-md"
                           placeholder="Search...">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-secondary btn-number">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>--}}

                <div class="input-group input-group-sm">

                    <ul class="navbar-nav m-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="color: #ffffff"> <i class="fa fa-phone"></i> হটলাইন:
                                ০১৮৮০-০৬০৯০৯</a>
                        </li>

                    </ul>

                </div>
                <a class="btn btn-success btn-sm ml-3" href="/customer/checkout">
                    <i class="fa fa-shopping-cart"></i> পণ্য
                    <span class="badge badge-light" ng-cloak>@{{ getProductCartInfo().totalCount}} টি </span>
                </a>

                @if( Session('customer_id')<=0)
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/customer/login">লগ-ইন</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav m-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/customer/registration">রেজিস্ট্রেশন </a>
                        </li>
                    </ul>

                @else
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                {{Session('customer_name')}}
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Setting</a>
                                <a class="dropdown-item" href="/customer/logout">Logout</a>
                            </div>
                        </li>
                    </ul>
                @endif


            </form>
        </div>
    </div>
</nav>
<section class="slider">
    <div class="container">
        <div class="card">
            <div class="card-body custom-body" style="padding: 100px 100px;">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4>Content Not found</h4>
                        <a href="/" class="btn btn-info">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('ecommerce.includes.footer')

</body>
</html>

