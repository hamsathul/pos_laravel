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
                        <ol class="breadcrumb m-0">
                            <a href="{{ route('add.permission')}}" class="btn btn-primary rounded-pill waves-effect waves-light">Add Permission</a>
                        </ol>
                    </div>
                    <h4 class="page-title">All Permissions</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">All Permissions</h4>

                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Permisison Name</th>
                                    <th>group Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($permissions as $key=>$item)


                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->group_name}}</td>
                        <td>

                            <a href="{{ route('edit.permission', $item->id)}}" class="btn btn-blue rounded-pill waves-effect waves-light">Edit</a>
                            <a href="{{ route('delete.permission', $item->id)}}"id="delete" class="btn btn-danger rounded-pill waves-effect waves-light">Delete</a>
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
