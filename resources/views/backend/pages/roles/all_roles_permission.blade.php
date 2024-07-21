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
                            <a href="{{ route('add.roles.permission')}}" class="btn btn-primary rounded-pill waves-effect waves-light">Add Role in permission</a>
                        </ol>
                    </div>
                    <h4 class="page-title">All Roles in Permission</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">All Roles in Permission</h4>

                        <table  class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Role Name</th>
                                    <th>Permission Name</th>
                                    <th width="18%">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($roles as $key=>$item)


                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item->name}}</td>
                        <td>
                            @foreach ($item->permissions as $permission)
                            <span class="badge rounded-pill bg-primary fs-5">{{$permission->name}}</span>
                            @endforeach
                            </td>
                        <td width="18%">

                            <a href="{{ route('admin.edit.roles', $item->id)}}" class="btn btn-blue rounded-pill waves-effect waves-light">Edit</a>
                            <a href="{{ route('admin.delete.roles', $item->id)}}"id="delete" class="btn btn-danger rounded-pill waves-effect waves-light">Delete</a>
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
