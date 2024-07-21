@extends('admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<style type="text/css">
    .form-check-label{
        text-transform: capitalize;
    }
</style>
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">

                    </div>
                    <h4 class="page-title">Edit Roles to Permissions</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-body">
                            <!-- end about me section content -->

                            <div class="tab-pane" id="settings">
                                <form id="myForm" method="post" action="{{ route('role.permission.update', $roles->id)}}" enctype="multipart/form-data">
                                    @csrf


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">Roles</label>
                                      <h3>{{ $roles->name}}</h3>
                                    </div>
                                </div>

                                <div class="form-check mb-2 form-check-primary">
                                    <input class="form-check-input" type="checkbox" name="" id="customcheck15">
                                    <label class="form-check-label" for="customcheck15">Primary</label>
                                </div>

                                <hr>
                                @foreach ($permission_groups as $group)


                                    <div class="row">
                                        <div class="col-3">

                                            @php
                                                $permissions = App\Models\User::getPermissionByGroupName($group->group_name);
                                            @endphp

                                <div class="form-check mb-2 form-check-primary">
                                    <input class="form-check-input" type="checkbox" name="" id="customcheck1" value="" {{App\Models\User::roleHasPermissions($roles, $permissions) ? 'checked' : ''}}>
                                    <label class="form-check-label" for="customcheck1">{{$group->group_name}}</label>
                                </div>
                                        </div>
                                        <div class="col-9">


                                            @foreach ($permissions as $permission)


                                            <div class="form-check mb-2 form-check-primary">
                                                <input class="form-check-input" type="checkbox" name="permission[]" id="customcheck{{$permission->id}}"
                                                 value="{{$permission->id}}" {{ $roles->hasPermissionTo($permission->name) ? 'checked':''}}>
                                                <label class="form-check-label" for="customcheck1">{{$permission->name}}</label>
                                            </div>
                                            @endforeach
                                            <br>
                                        </div>
                                    </div>    <!-- end row-->
                                    @endforeach
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                                    </div>
                                </form>
                            </div>
                            <!-- end settings content-->

                        <!-- end tab-content -->
                    </div>
                </div> <!-- end card-->

            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div> <!-- container -->

</div> <!-- content -->

<!-- validation -->

<script type="text/javascript">

    $('#customcheck15').click(function(){

        if($(this).is(':checked')) {
            $('input[type = checkbox]').prop('checked', true);
        }else{
            $('input[type = checkbox]').prop('checked', false);
        }
    })
</script>

@endsection
