@extends('admin_dashboard')
@section('admin')


<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        @if(Auth::user()->can('supplier.add'))
                        <ol class="breadcrumb m-0">
                            <a href="{{ route('add.supplier')}}" class="btn btn-primary rounded-pill waves-effect waves-light">Add Supplier</a>
                        </ol>
                        @endif
                    </div>
                    <h4 class="page-title">All Supplier</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">All Supplier</h4>

                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Shop Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($supplier as $key=>$item)


                    <tr>
                        <td>{{$key+1}}</td>
                        <td><img src="{{ asset($item->image)}}" style="width:50px; height: 40px;" ></td>
                        <td>{{$item->name}}</td>
                        <td>{{ $item->email}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->shopname}}</td>
                        <td>

                            @if(Auth::user()->can('supplier.view'))
                            <a href="{{ route('view.supplier', $item->id)}}" class="btn btn-info rounded-pill waves-effect waves-light" title="view"><i class="fa-solid fa-eye"></i></a>
                            @endif
                            @if(Auth::user()->can('supplier.edit'))
                            <a href="{{ route('edit.supplier', $item->id)}}" class="btn btn-blue rounded-pill waves-effect waves-light" title="edit"><i class="fa-solid fa-pen-to-square"></i></a>
                            @endif
                            @if(Auth::user()->can('supplier.delete'))
                            <a href="{{ route('delete.supplier', $item->id)}}"id="delete" class="btn btn-danger rounded-pill waves-effect waves-light" title="delete"><i class="fa-solid fa-trash-can"></i></a>
                            @endif
                        </td>
                    </tr>

                                @endforeach
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->



    </div> <!-- container -->

</div> <!-- content -->
@endsection
