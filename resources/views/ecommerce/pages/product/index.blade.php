@extends('layouts.general')

@section('title', '' . $product->product_name . '')

@section('content')

    <section class="slider">
        <div class="container">
            <div class="card">
                <div class="card-body custom-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="/"><strong><i class="fa fa-home"></i> হোম</strong></a> <i
                                    class="fa fa-chevron-right"></i>
                            <a href="/product/category/{{$product->category_id}}">{{$product->category_name}}</a>
                            <i class="fa fa-chevron-right"></i> <a href="#">{{$product->product_name}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shop-single section-padding pt-3">
        <div class="container">
            <div class="card">
                <div class="card-body custom-body">
                    <div class="row">
                        <div class="col-md-5">

                            <img ng-src="/images/product/{{$product->featured_image}}"
                                 class="img-thumbnail detail-product" height="200px">


                            <div class="row" style="padding-top: 20px">

                                @foreach($images as $image)
                                    <div class="col-md-6">
                                        <div class="item">
                                            <img alt="" ng-src="/images/product/{{$image->image_name}}"
                                                 class="img-thumbnail product-full-view"/>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="shop-detail-right">
                        <span class="badge badge-success">@if($product->discount_rate>0) {{$product->discount_rate}}%
                            ছাড়@else @endif</span>
                                <h2>{{$product->product_name}}</h2>
                                <h6><strong><span class="mdi mdi-approval"></span>প্রোপার্টিজ</strong>
                                    - {{$product->product_measurement}}</h6>
                                <p><strong><span class="mdi mdi-approval"></span> দাম:
                                    </strong> {{$product->selling_price}}টাকা <span
                                            class="price-discount">{{$product->regular_price}}টাকা</span></p>

                                <p><strong><span class="mdi mdi-approval"></span> বিবরণ:
                                    </strong> {{$product->product_details}}</p>
                                <div class="row">

                                    <div class="col-md-1">
                                        <button class="btn btn-success"
                                                ng-click="addQuantity()">-
                                        </button>
                                    </div>

                                    <div class="col-md-2">
                                        <input type="number" class="form-control"
                                               name="customer_email" value="1" ng-model="detail_page_quantity">
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn btn-success"
                                                ng-click="removeQuantity()">+
                                        </button>
                                    </div>

                                </div>

                                {{--<div class="col-md-5 row" style="padding-top: 10px">
                                    <div class="form-group">
                                        <label for="sel1">Color:</label>

                                        <select class="form-control" id="sel1">
                                            <option>Red</option>
                                            <option>Blue</option>
                                        </select>

                                    </div>
                                </div>
                                --}}

                                <br>
                                <div class="col-md-5 row">
                                    <button type="button" class="btn btn-sm btn-outline-success btn-block"
                                            ng-click="addToCartFromDetailsPage('{{$product->product_id}}','{{$product->product_name}}','{{$product->featured_image}}','{{$product->selling_price}}')">
                                        <i class="fa fa-shopping-cart"></i> কার্টে যুক্ত করুন
                                    </button>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="short-description">
                                <h5>বর্ণনা</h5>
                                <hr>
                                <p>{{$product->product_details}}</p>
                            </div>
                            {{-- <h6 class="mb-3 mt-4">Why shop from {{$shop->shop_name}} ?</h6>--}}
                        </div>
                    </div>
                </div>
            </div>


            <br>
            <div class="card">
                <div class="card-header">
                    <h5>এগুলিও দেখুন</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($products as $featured_item)
                            <div class="col-md-3 featured-product">
                                <a href="/product/details/{{$featured_item->product_id}}/{{str_replace(' ', '-', $featured_item->product_name)}}">
                                    <img ng-src="/images/product/{{$featured_item->featured_image}}"
                                         class="img-thumbnail detail-product" width="100%" height="135px">
                                    <a href="/product/details/{{$featured_item->product_id}}"
                                       class="card-title product-title">{{$featured_item->product_name}}</a>
                                    <p class="measurement">{{$featured_item->product_measurement}}</p>
                                    <p class="price">{{$featured_item->selling_price}}টাকা <span
                                                class="price-discount">{{$featured_item->regular_price}}টাকা</span>
                                    </p>
                                    <button type="button" class="btn btn-sm btn-outline-success btn-block"
                                            ng-click="addToCart('{{$featured_item->product_id}}','{{$featured_item->product_name}}','{{$featured_item->featured_image}}','{{$featured_item->selling_price}}')">
                                        <i class="fa fa-shopping-cart"></i> কার্টে যুক্ত করুন
                                    </button>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <br>
        </div>
    </section>


    @include('ecommerce.pages.home.universal_cart')
@endsection