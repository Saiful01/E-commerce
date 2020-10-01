@extends('layouts.general')

@section('title', 'কেনারহাট')

@section('content')


    <div class="slider">

        <div class="container">

            <div class="row">
                <div class="card" style="width: 100%;margin-bottom: 10px">
                    <div class="card-body custom-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="/"><strong><i class="fa fa-home"></i> হোম</strong></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="card" style="    width: 108%;">
                    <div class="col-md-12">

                        <div class="card-body">
                            <div class="row">
                                @foreach($categories as $category)
                                    <div class="col-md-2" style="padding-bottom: 15px;">
                                        <a href="/product/category/{{$category->category_id}}">
                                            <img class="img-thumbnail category-img"
                                                 ng-src="/images/category/{{$category->category_image}}" height="100px">
                                            <p class="card-title product-title">{{$category->category_name}}</p>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    @include('ecommerce.pages.home.universal_cart')--}}
@endsection



