@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box"><h4 class="page-title">Client </h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Client</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Show</a></li>
                </ol>
            </div>
        </div>
    </div><!-- end row -->


    <div class="row">
        <div class="col-lg-10">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Client </h4>
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Client Name</th>
                            <th>Client Image</th>
                            <th>Client Quotes</th>
                            <th>Date</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($clients as $client)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{$client->category_name}}</td>
                                <td><img src="/images/client/{{$client->client_image}}" width="50px"></td>

                                <td>{{$client->client_quotes}}</td>
                                <td>{{$client->updated_at}}</td>
                                <td>
                                    <div class="btn-group m-b-10">
                                        <button type="button" class="btn btn-info dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start"
                                             style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 33px, 0px);">
                                            <a class="dropdown-item" href="/admin/client/edit/{{$client->client_id}}">Edit</a>
                                            <a class="dropdown-item" href="/admin/client/delete/{{$client->client_id}}">Delete</a>

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