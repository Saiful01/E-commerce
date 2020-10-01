@extends('layouts.app')

@section('content')

    <style>
        p, h6, td, th {
            font-size: 17px;
            line-height: 20px;
        }
    </style>
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

    <div class="card m-b-20">

        <div class="card-body">

            <form method="post" class="form-inline" action="/admin/extra-product/store" enctype="multipart/form-data">
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
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="example-text-input" class=" col-form-label">Product Name</label>
                            <div class="form-group ">
                                <input class="form-control" type="text" name="product_name" required>
                                <input class="form-control" type="hidden" name="_token" value="{{csrf_token()}}">
                                <input class="form-control" type="hidden" name="sell_invoice"
                                       value="{{$customer->sell_invoice}}">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="example-text-input" class=" col-form-label">Product Unit</label>
                            <div class="form-group ">
                                <input class="form-control" type="text" name="quantity" required>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group ">
                            <label for="example-text-input" class=" col-form-label">Unit Price</label>
                            <div class="form-group ">
                                <input class="form-control" type="text" name="selling_price" required>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="example-text-input" class=" col-form-label">.</label>
                        <div class="form-group">

                            <button type="submit" class="form-control btn-primary">Save</button>

                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary waves-effect waves-light"
                        onclick="printDiv('printableArea')">Print
                </button>
            </div>
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

                <div class="card-body" id="printableArea" style="margin-top: -15px;">
                    <div class="row">
                        <div class="col-md-4">

                            <p>
                                কেনারহাট<br>
                                শেখ হাসিনা সফটওয়্যার টেকনোলজি পার্ক,<br> এমটি ভবন,৬ষ্ঠ তলা, যশোর।<br>
                                হটলাইন: ০১৮৮০-০৬০৯০৯ <br>
                                www.kenarhat.com
                            </p>
                        </div>

                        <div class="col-md-4" style="text-align: center">
                            <img class="img-thumbnail" style="height: 112px;margin-bottom: 4px"
                                 src="/ecommerce/img/theme_logo.jpg"/>
                            <p style="font-size: 12px;">তারুণ্যের নিরাপদ খাদ্য আন্দোলন...</p>
                        </div>

                        <div class="col-md-4">
                            <h6><strong>নাম: {{$customer->customer_name}}<br>
                                    ফোন: {{$customer->customer_phone}}<br>
                                    ঠিকানা: {{$customer->customer_address2}}<br>
                                    {{--জেলা: {{$customer->customer_city}}--}}</strong></h6>
                        </div>


                    </div>
                    <br>
                    <table class="table mb-0 table-bordered invoice">
                        <thead>
                        <tr>
                            <th style="padding-top: 5px;padding-bottom: 5px;text-align: right; color: black">
                                #
                            </th>
                            <th style="padding-top: 5px;padding-bottom: 5px;text-align: right; color: black">
                                নাম
                            </th>
                            <th style="padding-top: 5px;padding-bottom: 5px;text-align: right; color: black">
                                ইউনিট
                            </th>
                            <th style="padding-top: 5px;padding-bottom: 5px;text-align: right; color: black">
                                পরিমাণ
                            </th>
                            <th style="padding-top: 5px;padding-bottom: 5px;text-align: right; color: black">
                                ইউনিট প্রাইস
                            </th>

                            <th style="padding-top: 5px;padding-bottom: 5px;text-align:right; color: black">
                                মোট দাম
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @php($sub_total=0)
                        @foreach($products as $product)
                            <tr>
                                <td style="padding-top: 5px;padding-bottom: 5px;text-align: right;color: black">{{ $i++ }}</td>
                                <td style="padding-top: 5px;padding-bottom: 5px;text-align: right;color: black">{{$product->product_name}}</td>

                                <td style="padding-top: 5px;padding-bottom: 5px;text-align: right;color: black">
                                    {{$product->product_measurement}}

                                </td>
                                <td style="padding-top: 5px;padding-bottom: 5px;text-align: right;color: black">{{$product->quantity}}
                                    টি
                                </td>
                                <td style="padding-top: 5px;padding-bottom: 5px;text-align: right;color: black">{{$product->selling_price}}
                                    টাকা/ <span
                                            style="text-decoration: line-through;"> {{$product->regular_price}}
                                        টাকা</span></td>
                                <td style="padding-top: 5px;padding-bottom: 5px;text-align: right;color: black">{{$product->total_price}}
                                    টাকা
                                </td>

                            </tr>

                            @php($sub_total=$sub_total+$product->total)
                        @endforeach

                        </tbody>

                    </table>

                    <div class="row">
                        <div class="col-md-4">
                            <br>
                            <br>
                            <img class="img-thumbnail" style="height: 90px;" src="/ecommerce/img/kenarhat_qr.png"/>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <table style="width: 100%">
                                <tfoot class='table table-bordered' style="border: none">

                                <tr>

                                    <th style="padding-top: 5px;padding-bottom: 5px;color: black" colspan="2">শিপিং
                                        খরচ
                                    </th>
                                    <td style="padding-top: 5px;padding-bottom: 5px;text-align: right;color: black">{{$customer->shipping_cost}}
                                        টাকা
                                    </td>
                                </tr>

                                <tr>

                                    <th colspan="2" style="padding-top: 5px;padding-bottom: 5px">মোট
                                    </th>
                                    <td style="padding-top: 5px;padding-bottom: 5px;text-align: right;color: black">{{$customer->sub_total_price+$customer->shipping_cost}}
                                        টাকা
                                    </td>
                                </tr>

                                <tr>

                                    <th style="padding-top: 5px;padding-bottom: 5px;color: black" colspan="2">ছাড়</th>
                                    <td style="padding-top: 5px;padding-bottom: 5px;text-align: right;color: black">{{$customer->discount}}
                                        টাকা
                                    </td>
                                </tr>
                                <tr>

                                    <th style="padding-top: 5px;padding-bottom: 5px;color: black" colspan="2">অগ্রিম
                                    </th>
                                    <td style="padding-top: 5px;padding-bottom: 5px;text-align: right;color: black">{{$customer->paid_amount}}
                                        টাকা
                                    </td>
                                </tr>
                                <tr>

                                    <th style="padding-top: 5px;padding-bottom: 5px;color: black" colspan="2"><h6>
                                            <strong>সর্বমোট</strong></h6></th>
                                    <td style="padding-top: 1px;padding-bottom: 1px;text-align: right;color: black"><h6>
                                            <strong>{{$customer->sub_total_price+$customer->shipping_cost-$customer->discount-$customer->paid_amount}}
                                                টাকা</strong>
                                        </h6></td>
                                </tr>

                                </tfoot>
                            </table>
                        </div>
                    </div>
                    Invoice ID: <strong>#{{$customer->sell_invoice}}</strong>, {{date('M m, Y H:i:s')}}
                    ({{Session::get('name')}} )
                </div>
            </div>
        </div>
    </div>



    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
