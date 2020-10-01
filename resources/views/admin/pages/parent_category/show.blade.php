@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box"><h4 class="page-title">Parent Category</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Parent Category</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Show</a></li>
                </ol>
            </div>
        </div>
    </div><!-- end row -->


    <div class="row">
        <div class="col-lg-6">
            <div class="card m-b-20">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mt-0 header-title">Parent Categories</h4>


                        </div>
                        <div class="col-md-6">
                            <a href="/admin/parent/category/create" class="btn btn-primary float-right mb-2">+new</a>

                        </div>
                    </div>
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Parent Category Name</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($result as $res)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{$res->parent_category_name}}</td>
                                <td>
                                    <div class="btn-group m-b-10">
                                        <button type="button" class="btn btn-info dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start"
                                             style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 33px, 0px);">
                                            <a class="dropdown-item" href="/admin/parent/category/edit/{{$res->parent_category_id}}">Edit</a>
                                            <a class="dropdown-item" href="/admin/parent/category/delete/{{$res->parent_category_id}}">Delete</a>

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
