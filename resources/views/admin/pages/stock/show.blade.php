@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box"><h4 class="page-title">Product</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Product</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Show</a></li>
                </ol>
            </div>
        </div>
    </div><!-- end row -->


    <div class="row">
        <div class="col-lg-12">
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
                <div class="card-body">
                    <h4 class="mt-0 header-title">Product</h4>
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Regular price</th>
                            <th>Selling price</th>
                            <th>Measurement</th>
                            <th>Qnt</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($products as $product)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->regular_price}}</td>
                                <td>{{$product->selling_price}}</td>
                                <td>{{$product->product_measurement}}</td>
                                <td>@if($product->product_quantity==null)
                                        0 @else {{$product->product_quantity}}@endif</td>
                                <td>

                                    <button type="button" class="btn btn-primary waves-effect waves-light"
                                            data-toggle="modal" data-target=".bs{{$product->product_id}}">Load
                                    </button>


                                    <div class="modal fade bs{{$product->product_id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header"><h5 class="modal-title mt-0"
                                                                              id="mySmallModalLabel">Quantity</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="/admin/stock/store"
                                                          enctype="multipart/form-data">

                                                        <div class="form-group row">
                                                            <div class="col-sm-10">
                                                                <input class="form-control" type="hidden"
                                                                       name="product_id" value="{{$product->product_id}}">
                                                                <input class="form-control" type="number"
                                                                       name="product_quantity" required>
                                                                <input class="form-control" type="hidden" name="_token"
                                                                       value="{{csrf_token()}}">

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
                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection