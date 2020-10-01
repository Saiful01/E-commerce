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
                            <th>Category name</th>
                            <th>Keywords</th>
                            <th>Publish</th>
                            <th>Featured</th>
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
                                <td>{{$product->category_name}}</td>
                                <td>{{$product->keywords}}</td>
                                <td>
                                    @if($product->publish_status==1)
                                        <span class="badge badge-pill badge-info">Published</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">Unpublished</span>

                                    @endif
                                </td>
                                <td>
                                    @if($product->featured_product==1)
                                        <span class="badge badge-pill badge-info">Yes</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">No</span>

                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group m-b-10">
                                        <button type="button" class="btn btn-info dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start"
                                             style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 33px, 0px);">
                                            <a class="dropdown-item"
                                               href="/admin/product/edit/{{$product->product_id}}">Edit</a>
                                            <a class="dropdown-item"
                                               href="/admin/product/delete/{{$product->product_id}}">Delete</a>
                                            @if($product->publish_status==1)
                                                <a class="dropdown-item"
                                                   href="/admin/product/unpublish/{{$product->product_id}}">Unpublish</a>
                                            @else
                                                <a class="dropdown-item"
                                                   href="/admin/product/publish/{{$product->product_id}}">Publish</a>

                                            @endif

                                            @if($product->featured_product==1)
                                                <a class="dropdown-item"
                                                   href="/admin/product/feature-remove/{{$product->product_id}}">Remove Featured</a>
                                            @else
                                                <a class="dropdown-item"
                                                   href="/admin/product/feature/{{$product->product_id}}">Featured</a>

                                            @endif


                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                    {{ $products->links() }}
            </div>
        </div>
    </div>


@endsection
