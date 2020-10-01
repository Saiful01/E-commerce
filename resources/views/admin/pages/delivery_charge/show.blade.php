@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box"><h4 class="page-title">Delivery Charge </h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Delivery Charge</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Show</a></li>
                </ol>
            </div>
        </div>
    </div><!-- end row -->


    <div class="row">
        <div class="col-lg-10">
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
                    <h4 class="mt-0 header-title">Promo </h4>
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th>#</th>

                            <th>Inside Jassore</th>
                            <th>Outside Jassore</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($result as $res)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{$res->inside_jassore}}</td>
                                <td>{{$res->outside_jassore}}</td>

                                <td>
                                    <div class="btn-group m-b-10">
                                        <button type="button" class="btn btn-info dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start"
                                             style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 33px, 0px);">

                                            {{--             <a class="dropdown-item"
                                                            href="/admin/delivery-charge/edit/{{$res->delivery_charge_id}}">Edit</a>
                                                         <a class="dropdown-item"
                                                            href="/admin/delivery-charge/delete/{{$res->delivery_charge_id}}">Delete</a>--}}
                                            <a class="dropdown-item"
                                               href="/admin/delivery-charge/edit/{{$res->delivery_charge_id}}">Edit</a>{{--
                                            <a class="dropdown-item" href="/admin/delivery-charge/delete/{{$res->delivery_charge_id}}">Delete</a>--}}


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
