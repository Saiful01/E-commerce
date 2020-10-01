@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box"><h4 class="page-title">Pending Orders</h4>
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
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Subtotal</th>
                            <th>Shipping</th>
                            <th>Discount</th>
                            <th>Paid</th>
                            <th>Payable</th>
                            <th>Due</th>

                            <th>Address2</th>
                            <th>Status</th>
                            <th>Order time</th>
                            <th>City</th>
                            <th>Address</th>

                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @php($total=0)
                        @foreach($sells as $sell)
                            @php($total=$total+$sell->sub_total_price)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{$sell->customer_name}}</td>
                                <td>{{$sell->customer_phone}}</td>

                                <td>{{$sell->sub_total_price}}</td>
                                <td>{{$sell->shipping_cost}}</td>
                                <td>
                                    @if($sell->discount<=0)
                                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                                data-target="#myModal{{$i}}">Discount
                                        </button>
                                @else
                                    {{$sell->discount}}

                                @endif


                                <!-- Modal -->
                                    <div id="myModal{{$i}}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <form method="post" action="/admin/product/discount"
                                                          enctype="multipart/form-data">

                                                        <div class="form-group row" style="display: none">

                                                            <div class="col-sm-10">
                                                                <input class="form-control" type="hidden" name="_token"
                                                                       value="{{csrf_token()}}">
                                                                <input class="form-control" type="text" name="invoice"
                                                                       value="{{$sell->sell_invoice}}">

                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="example-text-input"
                                                                   class="col-sm-3 col-form-label">Total
                                                                Discount</label>
                                                            <div class="col-sm-9">
                                                                <input class="form-control" type="number"
                                                                       name="discount"
                                                                       value="0">

                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label"></label>
                                                            <div class="col-sm-9">
                                                                <button type="submit"
                                                                        class="btn btn-primary waves-effect waves-light">
                                                                    Submit
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>

                                <td>

                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                            data-target="#PaymentModal{{$i}}">Pay
                                    </button>


                                    <!-- Modal -->
                                    <div id="PaymentModal{{$i}}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <p>Already paid {{$sell->paid_amount}}</p>
                                                    <p>New paid amount will be added with previous amount.</p>
                                                    <form method="post" action="/admin/product/pay"
                                                          enctype="multipart/form-data">

                                                        <div class="form-group row" style="display: none">

                                                            <div class="col-sm-10">
                                                                <input class="form-control" type="hidden" name="_token"
                                                                       value="{{csrf_token()}}">
                                                                <input class="form-control" type="text" name="invoice"
                                                                       value="{{$sell->sell_invoice}}">

                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="example-text-input"
                                                                   class="col-sm-3 col-form-label">Payment</label>
                                                            <div class="col-sm-9">
                                                                <input class="form-control" type="number"
                                                                       name="paid_amount" value="0">

                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label"></label>
                                                            <div class="col-sm-9">
                                                                <button type="submit"
                                                                        class="btn btn-primary waves-effect waves-light">
                                                                    Submit
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{$sell->paid_amount}}
                                </td>
                                <td>{{$sell->total-$sell->discount}}</td>
                                <td>{{($sell->total-$sell->discount)-($sell->paid_amount)}}</td>
                                <td>
                                    @if($sell->customer_address2==null)
                                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                                data-target="#myModal{{$sell->sub_total_price}}">Address2
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                                data-target="#myModal{{$sell->sub_total_price}}"> {{$sell->customer_address2}}
                                        </button>


                                @endif


                                <!-- Modal -->
                                    <div id="myModal{{$sell->sub_total_price}}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <form method="post" action="/admin/address/save"
                                                          enctype="multipart/form-data">

                                                        <div class="form-group row" style="display: none">

                                                            <div class="col-sm-10">
                                                                <input class="form-control" type="hidden" name="_token"
                                                                       value="{{csrf_token()}}">
                                                                <input class="form-control" type="text"
                                                                       name="customer_id"
                                                                       value="{{$sell->customer_id}}">

                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="example-text-input"
                                                                   class="col-sm-3 col-form-label">Update
                                                                Address</label>
                                                            <div class="col-sm-9">
                                                                <textarea class="form-control" type="text"
                                                                          name="customer_address2">{{$sell->customer_address1}}</textarea>

                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label"></label>
                                                            <div class="col-sm-9">
                                                                <button type="submit"
                                                                        class="btn btn-primary waves-effect waves-light">
                                                                    Update Addres
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>

                                <td>@if($sell->delivery_status==0) <span
                                            class="badge badge-pill badge-warning">Pending</span> @elseif($sell->delivery_status==1)
                                        <span class="badge badge-pill badge-info">Confirm</span> @elseif($sell->delivery_status==2)
                                        <span class="badge badge-pill badge-success">Relaese</span> @elseif($sell->delivery_status==3)
                                        <span class="badge badge-pill badge-danger">Received</span> @else
                                        <span class="badge badge-pill badge-danger">Cancel</span>
                                    @endif</td>
                                <td>{{$sell->created_at}}</td>
                                <td>{{$sell->customer_city}}</td>
                                <td>{{$sell->customer_address1}}</td>

                                <td>
                                    <div class="btn-group m-b-10">
                                        <button type="button" class="btn btn-info dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start"
                                             style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 33px, 0px);">
                                            <a class="dropdown-item"
                                               href="/admin/product/confirm/{{$sell->sell_invoice}}"
                                               onclick="return confirm('Are you sure?');">Confirm</a>
                                            {{-- <a class="dropdown-item"
                                                href="/admin/product/delivery/{{$sell->sell_invoice}}">Release</a>
                                             <a class="dropdown-item"
                                                href="/admin/product/received/{{$sell->sell_invoice}}">Received</a>--}}
                                            @if(Session::get('user_type')==1)
                                                <a class="dropdown-item"
                                                   href="/admin/product/cancel/{{$sell->sell_invoice}}"
                                                   onclick="return confirm('Are you sure?');">Cancel</a>
                                            @endif
                                            <a class="dropdown-item"
                                               href="/admin/product/details/{{$sell->sell_invoice}}">Details</a>

                                        </div>
                                    </div>
                                </td>


                            </tr>
                        @endforeach

                        <p style="display: none">{{$total}}</p>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection