@extends('admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">

                    </div>
                    <h4 class="page-title">Edit Admin</h4>
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
                                <form id="myForm" method="post" action="{{ route('admin.user.update')}}" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="id" value="{{$adminuser->id}}">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="firstname" class="form-label">Name</label>
                                                <input type="text"  name="name" class="form-control" value="{{$adminuser->name}}">

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="firstname" class="form-label">Email</label>
                                                <input type="email"  name="email" class="form-control" value="{{$adminuser->email}}">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="firstname" class="form-label">Phone</label>
                                                <input type="text"  name="phone" class="form-control" value="{{$adminuser->phone}}">

                                            </div>
                                        </div>



                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">Assigned Roles</label>
                                        <select name = "roles" class="form-select @error('year') is-invalid

                                        @enderror" id="example-select">
                                            <option selected disabled="">Select Roles</option>
                                            @foreach ($roles as $role)
                                                <option value ="{{$role->id}}" {{$adminuser->hasRole($role->name) ? 'selected':'empty'}}>{{$role->name}}</option>
                                            @endforeach


                                        </select>
                                    </div>
                                </div>


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
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                },
                email: {
                    required : true,
                },
                phone: {
                    required : true,
                },
                photo: {
                    required : true,
                },
                password: {
                    required : true,
                },
                roles: {
                    required : true,
                },

            },
            messages :{
                name: {
                    required : 'Please Enter  Name',
                },
                email: {
                    required : 'Please enter email',
                },
                phone: {
                    required : 'Please enter phone',
                },
                photo: {
                    required : 'Please Enter photo',
                },
                password: {
                    required : 'Please Enter password',
                },
                roles: {
                    required : 'Please Select roles',
                },

            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });

</script>



<script type="text/javascript">

	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload =  function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>

@endsection
