@extends('layouts.general')

@section('title', 'কেনারহাট')

@section('content')


    <div class="slider">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body custom-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <span style="    line-height: 22px;
    padding-left: 8px;">পণ্য : @{{ getProductCartInfo().totalCount}} টি </span>
                                </div>
                                <div class="col-md-6">

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td>মোট দাম</td>
                                                <td>@{{ totalPriceCountAll}} টাকা</td>
                                            </tr>
                                            <tr>
                                                <td>ডেলিভারি খরচ</td>
                                                <td>@{{ shipping_cost}} টাকা</td>
                                            </tr>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>সর্বমোট দাম :</th>
                                                <th>@{{ shipping_cost+totalPriceCountAll }} টাকা</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <span ng-repeat="item in cartItemPList">
                                        <div class="row">
                                            <div class="col-2">
                                                  <img class="img-thumbnail" src="/images/product/@{{ item.image}}"
                                                       height="50px"/>
                                            </div>
                                            <div class="col-4">
                                                <p>@{{ item.name}}</p>
                                            </div>
                                            <div class="col-2" style="margin: 0px;padding: 0px">

                                                <button class="btn btn-sm btn-success"
                                                        ng-click="itemMinus(item)">-</button>
                                                <span>@{{ item.qnt}}</span>
                                                <button class="btn btn-sm btn-success"
                                                        ng-click="itemAdd(item)">+</button>




                                            </div>

                                            <div class="col-2"> @{{ item.qnt* item.price}}</div>
                                            <div class="col-2"><a style="cursor: pointer;line-height: 30px"><i
                                                            class="fa fa-trash btn btn-outline-danger"
                                                            ng-click="removeItem(item)"></i></a>
                                            </div>
                                        </div>
                                        <hr style="padding: 0px;margin: 5px;">

                          </span>

                        </div>
                    </div>
                </div>

                <div class="col-md-5">

                    <div class="row">
                        <div class="col-md">

                            <div class="card">
                                <div class="col-md-6">
                                    <h5>রেজিস্ট্রেশন</h5>
                                    <hr class="horizontal-line">
                                </div>
                                <div class="card-body">
                                    {{-- <form method="get" action="#" enctype="multipart/form-data"
                                           class="ng-pristine ng-valid">--}}

                                    @if(Session::get('customer_id')!=null)
                                        <div data-ng-init="getCustomerProfile({{Session::get('customer_id')}})"></div>
                                    @endif

                                    <div class="form-group required">
                                        <label for="input-payment-firstname" class="control-label">জোন পছন্দ করুন<span
                                                    style="color: red">*</span></label>

                                        <label>
                                            <select class="form-control" ng-model="zone" ng-change="zoneChange(zone)">
                                                <option value="1">যশোরের মধ্যে</option>
                                                <option value="2">যশোরের বাইরে</option>
                                            </select>
                                        </label>
                                    </div>


                                    <div class="form-group required">
                                        <label for="input-payment-firstname" class="control-label">পুরো নাম<span
                                                    style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="firstname"
                                               name="customer_name" required=""
                                               ng-model="customer_name">
                                        <input class="form-control" type="hidden" name="_token"
                                               value="{{csrf_token()}}" autocomplete="off">
                                        {{-- <input class="form-control" type="hidden" ng-model="customer_id"
                                                value="@if(Session::get('customer_id')!=null){{Session::get('customer_id')}}@endif">--}}
                                    </div>
                                    <div class="form-group required">
                                        <label for="input-payment-lastname" class="control-label">ফোন<span
                                                    style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="input-payment-lastname"
                                               name="customer_phone" required=""
                                               ng-model="customer_phone">
                                    </div>
                                    <div class="form-group">
                                        <label for="input-payment-email" class="control-label">ইমেইল</label>
                                        <input type="text" class="form-control" id="input-payment-email"
                                               name="customer_email" ng-model="customer_email">
                                    </div>
                                    <div class="form-group required">
                                        <label for="input-payment-telephone" class="control-label">ঠিকানা<span
                                                    style="color: red">*</span></label>
                                        <textarea type="text" class="form-control" id="input-payment-telephone"
                                                  name="customer_address1"
                                                  required="" ng-model="customer_address1"></textarea>
                                    </div>
                                    <div class="form-group" style="display: none">
                                        <label for="input-payment-telephone" class="control-label">Address2</label>
                                        <textarea type="text" class="form-control" id="input-payment-telephone"
                                                  placeholder="Address2" name="customer_address2"></textarea>
                                    </div>

                                    <div class="form-group required">
                                        <label for="input-payment-telephone" class="control-label">জেলা<span
                                                    style="color: red">*</span></label>
                                        <input type="text" class="form-control"
                                               name="customer_city" required=""
                                               ng-model="customer_city">
                                    </div>

                                    <div class="form-group" style="display: none">
                                        <label for="input-payment-fax" class="control-label">দেশ</label>
                                        <input type="text" class="form-control"
                                               value="Bangladesh" name="customer_country">
                                    </div>

                                    <div class="pull-left">
                                        <button class="btn btn-success" ng-click="saveProducts(cartItemPList)">অর্ডার
                                            করুন
                                        </button>
                                    </div>
                                    {{-- </form>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection



