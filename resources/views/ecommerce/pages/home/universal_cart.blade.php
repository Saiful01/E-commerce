<div class="bottom-right card" ng-if="cartActive" ng-click="showPopover()" ng-cloak>

    <div class="counter"><p>@{{ getProductCartInfo().totalCount }}</p></div>
    <a href="">
        <i class="fa fa-shopping-bag"></i>
        <div class="total-section">
            <p class="shopping-cart-total"><i class="lol fa fa-money" aria-hidden="true"></i> @{{ totalPriceCountAll}}
            </p>
        </div>

    </a>
</div>

<div class="" ng-show="popoverIsVisible" ng-cloak>
    <div class="card full-cart">

        <div class="card-header full-cart-header" style="padding: 2px;">
            <p style="    color: #fff;
    padding: 5px;">@{{ getProductCartInfo().totalCount}} টি পন্য <span class="close-btn">  <a
                            class="btn btn-sm btn-danger btn-close" href="" ng-click="hidePopover()"
                            style="text-align: right;right: 0"><i class="fa fa-times"></i> বন্ধ করুন</a></span>
            </p>
        </div>
        <div class="card-body item-list" style="padding: 0px">

            {{--<pre>@{{ cartItemPList |json }}</pre>--}}
            <span ng-repeat="item in cartItemPList">
                    <div class="row" style="padding: 2px;">
                        <div class="col-3">
                            <img src="/images/product/@{{ item.image}}" width="100%" height="50px"/>
                        </div>
                        <div class="col-4">
                            <p style="margin-top: 10px;"><span style="font-size: 14px"><a
                                            href="/product/details/@{{ item.id }}"> @{{ item.name}}</a></span></p>
                        </div>
                        <div class="col-1">
                           {{-- <i class="fa fa-plus-square"></i>--}}
                            <span style="font-size: 13px;line-height: 45px;text-align: center">@{{ item.qnt}}</span>
                             {{--<i class="fa fa-plus-square"></i>--}}
                        </div>
                        <div class="col-2"> <span
                                    style="font-size: 12px;line-height: 45px;">@{{ item.qnt* item.price}}</span></div>
                        <div class="col-2"><a style="cursor: pointer;line-height: 45px"><i
                                        class="fa fa-trash btn btn-outline-danger" ng-click="removeItem(item)"></i></a></div>
                    </div>
                    <hr style="padding: 0px;margin: 5px;">
            </span>
        </div>
        <div class="card-footer">
            <div class="row">
                <p style="padding-left: 120px">সর্বমোট: @{{ totalPriceCountAll}}টাকা</p>
                <hr>
                <div class="btn-group">
                    <a href="/customer/checkout" class="btn btn-success"><i class="fa fa-shopping-cart"></i> অর্ডার করুন</a>
                    <button type="button" class="btn btn-info" ng-click="hidePopover()"><i class="fa fa-cart-plus"></i>
                        আরো যুক্ত করুন
                    </button>

                </div>
            </div>

        </div>
    </div>
</div>