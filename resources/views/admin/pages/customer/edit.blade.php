@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box"><h4 class="page-title">Customer Update</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Customer</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Show</a></li>
                </ol>
            </div>
        </div>
    </div><!-- end row -->


    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card m-b-20">
                <div class="card-body">
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


                    <h4 class="mt-0 header-title">Customers</h4>

                    <form method="post" action="/customer/update" enctype="multipart/form-data"
                          class="ng-pristine ng-invalid ng-invalid-required">
                        <div class="form-group required">
                            <label for="input-payment-firstname" class="control-label">পুরো নাম<span
                                        style="color: red;">*</span></label>
                            <input type="text" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" name="customer_name" required="" value="{{$customer->customer_name}}">
                            <input class="form-control" type="hidden" name="_token"
                                   value="{{csrf_token()}}">
                            <input class="form-control" type="hidden" name="customer_id"
                                   value="{{$customer->customer_id}}" autocomplete="off">
                        </div>
                        <div class="form-group required">
                            <label for="input-payment-lastname" class="control-label">ফোন নাম্বার<span
                                        style="color: red;">*</span></label>
                            <input type="text"
                                   class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required"
                                   name="customer_phone" required="" value="{{$customer->customer_phone}}">
                        </div>

                        <div class="form-group">
                            <label for="input-payment-email" class="control-label">ইমেইল</label>
                            <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-empty"
                                   name="customer_email" value="{{$customer->customer_email}}">
                        </div>
                        <div class="form-group required">
                            <label for="input-payment-telephone" class="control-label">ঠিকানা<span
                                        style="color: red;">*</span></label>
                            <textarea type="text"
                                      class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required"
                                      name="customer_address1" required="" >{{$customer->customer_address1}}</textarea>
                        </div>
                        <div class="form-group" style="display: none">
                            <label for="input-payment-telephone" class="control-label">Address2</label>
                            <textarea type="text" class="form-control" placeholder="Address2"
                                      name="customer_address2">{{$customer->customer_address2}}</textarea>
                        </div>

                        <div class="form-group required">
                            <label for="input-payment-telephone" class="control-label">জেলা<span
                                        style="color: red;">*</span></label>
                            <input type="text"
                                   class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required"
                                   name="customer_city" required="" value="{{$customer->customer_city}}">
                        </div>


                        <div class="pull-left">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection