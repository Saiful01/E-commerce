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
                                <a href="/"><strong><i class="fa fa-home"></i> হোম</strong></a> <i
                                        class="fa fa-chevron-right"></i>
                                <a href="#">{{$category_name}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="card" style="    width: 108%;">
                    <div class="col-md-12">

                        <div class="card-body custom-body">

                            <div class="row">
                                @if(count($products)<=0)

                                    <div class="col-lg-9 mx-auto wow zoomIn" data-wow-delay="0.2s" style="padding: 50px">
                                        <div class="box_style_1">
                                            <h6 class="text-danger"> There Are No Product</h6>
                                        </div>

                                    </div>
                                @endif

                                @foreach($products as $featured_item)
                                    <div class="col-md-2 featured-product">
                                        <a href="/product/details/{{$featured_item->product_id}}/{{str_replace(' ', '-', $featured_item->product_name)}}">
                                            <img src="/images/product/{{$featured_item->featured_image}}"
                                                 class="img-thumbnail general-product" width="100%" height="auto">
                                            <p class="card-title product-title">{{$featured_item->product_name}}</p>
                                            <p class="measurement">{{$featured_item->product_measurement}}</p>
                                            <p class="price">{{$featured_item->selling_price}}টাকা <span
                                                        class="price-discount ml-1">{{$featured_item->regular_price}}
                                                    টাকা</span></p>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-success btn-block"
                                                ng-click="addToCart('{{$featured_item->product_id}}','{{$featured_item->product_name}}','{{$featured_item->featured_image}}','{{$featured_item->selling_price}}')">
                                            <i class="fa fa-shopping-cart"></i> কার্টে যুক্ত করুন
                                        </button>

                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('ecommerce.pages.home.universal_cart')
@endsection



