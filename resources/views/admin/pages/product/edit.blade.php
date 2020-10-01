@extends('layouts.app')


@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box"><h4 class="page-title">Products</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Product</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Create</a></li>
                </ol>
            </div>
        </div>
    </div><!-- end row -->
    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
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

                <div class="card-body"><h4 class="mt-0 header-title">Product Details</h4>

                    <form method="post" action="/admin/product/update" enctype="multipart/form-data">


                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Product Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="product_name" value="{{$product->product_name}}">
                                <input class="form-control" type="hidden" name="_token" value="{{csrf_token()}}">
                                <input class="form-control" type="hidden" name="product_id" value="{{$product->product_id}}">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Product Details</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" type="text" name="product_details">{{$product->product_details}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Product Regular Price</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="regular_price" value="{{$product->regular_price}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Product Discount Rate</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="discount_rate" value="{{$product->discount_rate}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Product Selling Price</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="selling_price" value="{{$product->selling_price}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Product Measurement</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="product_measurement" value="{{$product->product_measurement}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Product Brand name</label>
                            <div class="col-sm-10">
                                <select class="custom-select" name="brand_id">
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Product Category</label>
                            <div class="col-sm-10">
                                <select class="custom-select" name="product_category_id">
                                    @foreach($categories as $category)
                                        <option value="{{$category->category_id}}" @if($product->category_id==$category->category_id) selected @endif>{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Product Keywords</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" type="text" name="keywords">{{$product->keywords}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Featured Image <span style="color: red">600*600PX</span></label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="feature_image" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Product Image1 <span style="color: red">600*600PX</span></label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="product_image1">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Product Image2 <span style="color: red">600*600PX</span></label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="product_image2">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
