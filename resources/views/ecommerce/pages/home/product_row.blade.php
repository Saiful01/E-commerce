<br>
<div class="categories">
    <div class="container">
        <div class="row">
            <div class="col-md-3">


                <div class="card-body" style="margin-top: -20px;">
                    <div class="row left-product">
                        <img ng-src="/images/promotion/{{$promotions[0]->promotion_image}}" width="100%">

                    </div>

                </div>

                <div class="card">

                    <div class="col-md-12">
                        <h5>হট প্রোডাক্ট</h5>
                        <hr class="horizontal-line">
                    </div>

                    <div class="card-body">
                        @if($hot_item!=null)
                            <a href="/product/details/{{$hot_item->product_id}}/{{str_replace(' ', '-', $hot_item->product_name)}}">
                                <img ng-src="/images/product/{{$hot_item->featured_image}}" class="img-thumbnail"
                                     width="100%">
                                <p class="card-title product-title">{{$hot_item->product_name}}</p>
                                <p class="measurement">{{$hot_item->product_measurement}}</p>
                                <p class="price">{{$hot_item->selling_price}} টাকা/ <span
                                            class="price-discount">{{$hot_item->regular_price}} টাকা</span></p>
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-success btn-block"
                                    ng-click="addToCart('{{$hot_item->product_id}}','{{$hot_item->product_name}}','{{$hot_item->featured_image}}','{{$hot_item->selling_price}}')">
                                <i class="fa fa-shopping-cart"></i> কার্টে যুক্ত করুন
                            </button>
                        @endif
                    </div>
                </div>

            </div>
            <div class="col-md-9">
                <div class="card">

                    <div class="col-md-3">
                        <h5> নতুন প্রোডাক্ট</h5>
                        <hr class="horizontal-line">
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @foreach($new_products as $new_product)
                                <div class="col-md-4 col-6 featured-product">
                                    <a href="/product/details/{{$new_product->product_id}}/{{str_replace(' ', '-', $new_product->product_name)}}">
                                        <img ng-src="/images/product/{{$new_product->featured_image}}"
                                             class="img-thumbnail general-product" width="100%" height="auto">
                                        <p class="card-title product-title">{{$new_product->product_name}}</p>
                                        <p class="measurement">{{$new_product->product_measurement}}</p>
                                        <p class="price ">{{$new_product->selling_price}} টাকা/ <span
                                                    class="price-discount ml-1 ">{{$new_product->regular_price}} টাকা</span>
                                        </p>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-success btn-block"
                                            ng-click="addToCart('{{$new_product->product_id}}','{{$new_product->product_name}}','{{$new_product->featured_image}}','{{$new_product->selling_price}}')">
                                        <i class="fa fa-shopping-cart"></i> কার্টে যুক্ত করুন
                                    </button>

                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <br>
                <div class="card">

                    <div class="card-body">
                        <a href="#"> <img src="/images/promotion/{{$promotions[1]->promotion_image}}"
                                          class="promotion-img" width="100%" height=""/></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
