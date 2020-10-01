@extends('layouts.general')

@section('title', 'Cart')

@section('content')


    <div class="slider">
        <div class="container">
            <div class="row">

                <div class="col-md-5 mx-auto">

                    <div class="row">
                        <div class="col-md">

                            <div class="card">
                                <div class="col-md-6">
                                    <h5>রেজিস্ট্রেশন</h5>
                                    <hr class="horizontal-line">
                                </div>

                                <div class="card-body">
                                    <form method="post" action="/customer/register/store" enctype="multipart/form-data"
                                          class="ng-pristine ng-valid">
                                        <div class="form-group required">
                                            <label for="input-payment-firstname" class="control-label">পুরো নাম<span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" id="firstname"
                                                   name="customer_name" required=""
                                                   ng-model="customer_name">
                                            <input class="form-control" type="hidden" name="_token"
                                                   value="{{csrf_token()}}" autocomplete="off">
                                        </div>
                                        <div class="form-group required">
                                            <label for="input-payment-lastname" class="control-label">ফোন নাম্বার<span style="color: red;">*</span></label>
                                            <input type="text" class="form-control"
                                                   name="customer_phone" required=""
                                                   ng-model="customer_phone">
                                        </div>

                                        <div class="form-group">
                                            <label for="input-payment-email" class="control-label">ইমেইল</label>
                                            <input type="text" class="form-control"
                                                   name="customer_email" ng-model="customer_email">
                                        </div>
                                        <div class="form-group required">
                                            <label for="input-payment-telephone" class="control-label">ঠিকানা<span style="color: red;">*</span></label>
                                            <textarea type="text" class="form-control"
                                                      name="customer_address1"
                                                      required="" ng-model="customer_address1"></textarea>
                                        </div>
                                        <div class="form-group" style="display: none">
                                            <label for="input-payment-telephone" class="control-label">Address2</label>
                                            <textarea type="text" class="form-control"
                                                      placeholder="Address2" name="customer_address2"></textarea>
                                        </div>

                                        <div class="form-group required">
                                            <label for="input-payment-telephone" class="control-label">জেলা<span style="color: red;">*</span></label>
                                            <input type="text" class="form-control"
                                                   name="customer_city" required=""
                                                   ng-model="customer_city">
                                        </div>

                                        <div class="form-group" style="display: none">
                                            <label for="input-payment-fax" class="control-label">দেশ</label>
                                            <input type="text" class="form-control"
                                                   value="Bangladesh" name="customer_country">
                                        </div>

                                        <div class="form-group">
                                            <label for="input-payment-email" class="control-label">পাসওয়ার্ড<span style="color: red;">*</span></label>
                                            <input type="password" class="form-control"
                                                   name="customer_password" ng-model="customer_password" required>
                                        </div>

                                        <div class="pull-left">
                                            <button class="btn btn-success">রেজিস্ট্রেশন</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection



